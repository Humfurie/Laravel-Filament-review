<?php

namespace App\Domain\Permission\Enums;

enum Permission:string
{
    case VIEWANY = "viewAny";
    case VIEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case RESTORE = 'restore';
    case FORCEDELETE = 'forceDelete';
}
