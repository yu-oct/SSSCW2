<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Upload;

class UploadPolicy
{
    public function view(User $user, Upload $upload)
    {
    // Check if the user has the 'admin' role
    if ($user->hasRole('admin')) {
        return true; // Admins can view all uploads
    }
    // Check if the user is the owner of the upload
    return $user->id == $upload->user_id;
}
public function show(User $user, Upload $upload)
{
    return $user->isAdmin() || $user->id == $upload->user_id;
}
    public function update(User $user, Upload $upload)
{
    return $user->isAdmin() || $user->id == $upload->user_id;

}

public function delete(User $user, Upload $upload)
{
    return $user->isAdmin() || $user->id == $upload->user_id;

}
public function edit(User $user, Upload $upload)
{
    return $user->isAdmin() || $user->id == $upload->user_id;
}
}


