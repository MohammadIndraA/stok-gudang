<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Support\Str;
class Permission extends SpatiePermission
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';


}
