<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feedback; 

class FeedbackPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }
}
