<?php

namespace App\Policies;

use App\{Upload, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Upload $upload
     * @return bool
     */
    public function touch(User $user, Upload $upload)
    {
        return $user->id === $upload->user_id;
    }
}
