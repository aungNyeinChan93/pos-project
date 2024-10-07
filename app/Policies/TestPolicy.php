<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class TestPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function delete(User $user ,Comment $comment){
        return $user->id == $comment->id;
    }

}
