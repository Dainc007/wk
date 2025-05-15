<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\LeagueResource\Widgets;

use App\Models\League;
use App\Models\LeagueTable;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

final class LeagueTableWidget extends BaseWidget
{
    public ?League $record = null;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $baseQuery = LeagueTable::query()
            ->join('teams', 'league_tables.team_id', '=', 'teams.id')
            ->select('league_tables.*', 'teams.name as team_name');

        return $table
            ->heading($this->getTableHeading())
            ->paginated(false)
            ->hiddenFilterIndicators(true)
            ->filters([
                Tables\Filters\SelectFilter::make('season')
                    ->selectablePlaceholder(false)
                    ->label('Season')
                    ->options(function () {
                        if (! $this->record instanceof League) {
                            return [];
                        }

                        return $this->record->seasons()
                            ->orderBy('season', 'desc')
                            ->pluck('season', 'id')
                            ->toArray();
                    })
                    ->attribute('league_season_id')
                    ->default(function () {
                        if (! $this->record instanceof League) {
                            return null;
                        }

                        $latestSeason = $this->record->seasons()
                            ->orderBy('season', 'desc')
                            ->first();

                        return $latestSeason?->id;
                    }),
            ])

            ->query(
                $baseQuery
            )
            ->defaultSort('points', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                return $query
                    ->orderBy('wins', 'desc')
                    ->orderBy('scored', 'desc');
            })
            ->emptyStateHeading('No teams in this league season')
            ->emptyStateDescription('This league season has no teams or standings yet.')
            ->striped()
            ->columns([
                Tables\Columns\ColorColumn::make('color')
                    ->sortable(false)
                    ->label('')
                    ->state(static function ($rowLoop): string {
                        $numOfRecords = $rowLoop->count;
                        if ($rowLoop->iteration <= 4) {
                            return 'green';
                        }

                        if ($rowLoop->iteration <= 6) {
                            return 'orange';
                        }

                        if ($rowLoop->iteration === 18) {
                            return 'pink';
                        }

                        if ($rowLoop->iteration > 18) {
                            return 'red';
                        }

                        return '';
                    }),
                Tables\Columns\TextColumn::make('position')
                    ->sortable(false)
                    ->label('')
                    ->state(static function ($rowLoop): int {
                        return $rowLoop->iteration;
                    }),

                Tables\Columns\TextColumn::make('team_name')
                    ->label('Team')
                    ->sortable(),

                Tables\Columns\TextColumn::make('played')
                    ->label('P')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('wins')
                    ->label('W')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('draws')
                    ->label('D')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('losses')
                    ->label('L')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('scored')
                    ->label('GF')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('coincided')
                    ->label('GA')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('goal_difference')
                    ->label('GD')
                    ->alignCenter()
                    ->state(function (LeagueTable $record): int {
                        return $record->scored - $record->coincided;
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('points')
                    ->label('Pts')
                    ->alignCenter()
                    ->sortable()
                    ->weight('bold'),
            ]);
    }

    protected function getTableHeading(): string
    {
        return $this->record->name.' League Standings';
    }
}
