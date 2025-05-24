<?php

declare(strict_types=1);

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

final class Permission extends SpatiePermission
{
    protected $fillable = ['name', 'guard_name'];
}
