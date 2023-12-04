<?php

namespace App\Policies;

use App\Models\User;

class AdminUserPolicy
{
    /**
     * Create a new policy instance.
     */

//     public function adminAction(User $user)
// {
//     return $user->isAdmin();
// }
public function viewAny(User $user, Upload $upload)
    {
        // 所有管理员都有查看所有内容的权限
        return $user->role === 'admin';
    }

    public function updateAny(User $user)
    {
        // 所有管理员都有编辑所有内容的权限
        return $user->role === 'admin';
    }

    public function deleteAny(User $user)
    {
        // 所有管理员都有删除所有内容的权限
        return $user->role === 'admin';
    }
    public function editAny(User $user)
    {
        // 所有管理员都有删除所有内容的权限
        return $user->role === 'admin';
    }
}
