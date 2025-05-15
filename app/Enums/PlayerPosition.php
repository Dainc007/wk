<?php

declare(strict_types=1);

namespace App\Enums;

enum PlayerPosition: string
{
    case STRIKER = 'striker';
    case MIDFIELDER = 'midfielder';
    case DEFENDER = 'defender';
    case GOALKEEPER = 'goalkeeper';

    case GK = 'gk';
    case CB = 'cb';
    case RB = 'rb';
    case LB = 'lb';
    case CDM = 'cdm';
    case CM = 'cm';
    case CAM = 'cam';
    case RM = 'rm';
    case LM = 'lm';
    case RW = 'rw';
    case LW = 'lw';
    case ST = 'st';
    case CF = 'cf';
    case FW = 'fw';
    case SW = 'sw';

    public function getLabel(): string
    {
        return $this->value;
    }
}
