<?php

namespace App\Domain\Post\Enums;

enum Status:string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
