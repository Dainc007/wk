<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Competition;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

final class FixtureService
{
    /**
     * @var Collection<int, Team>
     */
    public Collection $teams;

    public Competition $competition;

    /**
     * @param  Collection<int, Team>  $teams
     */
    public function __construct(
        Collection $teams,
        ?Competition $competition = null
    ) {
        $this->teams = $teams;
        $this->competition = $competition ?? new Competition;
    }

    public function generateSchedule(): void
    {
        $meetings = self::generateRound();
        $startDate = today();
        $date = today();

        foreach ($meetings as $matches) {
            if ($date->dayOfWeek === 0) {
                $date->next(Fixture::WEEKDAY);
            } else {
                $date->next(Fixture::WEEKEND_DAY);
            }

            foreach ($matches as $teams) {
                [$host, $visitor] = $teams;

                (new Fixture([
                    'host_id' => $host->id,
                    'visitor_id' => $visitor->id,
                    'date' => $date,
                ]))->save();
            }
        }

        Competition::updateOrCreate(['id' => $this->competition->id], ['start' => $startDate, 'end' => $date]);
    }

    /**
     * Generate a single round of matches, ensuring no team plays twice in the same round
     *
     * @return array<int, array<int, array>>
     */
    private function generateRound(): array
    {
        $pairs = $this->generatePairs();
        $map = [];

        return $this->assignPairsToRounds($pairs, $map);
    }

    /**
     * Generate all possible pairs with their unique binary flag of two positive bits
     * Next Flatten the array to make binary flags the keys
     *
     * @return array<int, array{teams: array, flag: int}>
     */
    private function generatePairs(): array
    {
        $pairs = [];

        foreach ($this->teams->slice(0, -1) as $teamIndex => $team) {
            foreach ($this->teams->slice($teamIndex + 1) as $opponentIndex => $opponent) {
                $pairs[] = ['teams' => [$team, $opponent], 'flag' => (2 ** $teamIndex) | (2 ** $opponentIndex)];
            }
        }

        shuffle($pairs);

        return array_combine(
            array_column($pairs, 'flag'),
            array_column($pairs, 'teams')
        );
    }

    /**
     * Assign pairs to rounds, ensuring no team plays twice in the same round
     *
     * @param  array<int, array>  $pairs
     * @param  array<int, int>  $map
     * @return array<int, array<int, array>>
     */
    private function assignPairsToRounds(array $pairs, array &$map): array
    {
        $result = array_fill(0, count($this->teams) - 1, []);

        foreach ($pairs as $pairFlag => $teams) {
            $matchingRound = $this->findMatchingRound($pairFlag, $map);

            if ($matchingRound === null) {
                $matchingRound = count($map);
                $map[] = $pairFlag;
            } else {
                $map[$matchingRound] |= $pairFlag;
            }

            $result[$matchingRound][] = $teams;
        }

        return $result;
    }

    /**
     * Find a matching round for a pair of teams
     *
     * @param  array<int, int>  $map
     */
    private function findMatchingRound(int $pairFlag, array &$map): ?int
    {
        foreach ($map as $round => $roundFlag) {
            if (($roundFlag & $pairFlag) === 0) {
                return $round;
            }
        }

        return null;
    }
}
