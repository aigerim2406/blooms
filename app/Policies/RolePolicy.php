<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
//    public function viewAny(User $user)
//    {
//        return ($user->role->name != 'user');
//    }

    public function view(User $user, Role $role)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Role $role)
    {
        //
    }

    public function delete(User $user, Role $role)
    {
        //
    }

    public function restore(User $user, Role $role)
    {
        //
    }

    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
