<?php

namespace App\Traits;

use App\Role;

trait HasRoles
{
    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        if (! $this->roles->contains('name', $role)) {
            return false;
        }

        return true;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}