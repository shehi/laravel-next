<?php

declare(strict_types=1);

namespace App\Enums;

enum Sort: int
{
    case ASC = 1;
    case DESC = -1;
    case NONE = 0;
}
