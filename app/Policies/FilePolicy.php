<?php

namespace App\Policies;

use App\{User, File};
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param File $file
     * @return bool
     */
    public function touch(User $user, File $file)
    {
        return $user->id === $file->user_id;
    }
}
