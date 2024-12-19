<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user)
    {
        // Бұл функцияға қажет логиканы қосуды ұмытпа
    }

    public function view(User $user, Post $post)
    {
        // Бұл функцияға қажет логиканы қосуды ұмытпа
    }

    public function create(User $user)
    {
        // Рөлді тексеріп, тек "admin" болған жағдайда рұқсат беру
        return $user->role && $user->role === 'admin';
    }

    public function update(User $user, Post $post)
    {
        // Тек "admin" болған жағдайда рұқсат беру
        return $user->role && $user->role === 'admin';
    }

    public function delete(User $user, Post $post)
    {
        // Егер қолданушы өзінің постын өшіргісі келсе немесе рөлі "user" емес болса, рұқсат беру
        return ($user->id === $post->user_id) || ($user->role && $user->role !== 'user');
    }

    public function restore(User $user, Post $post)
    {
        // Бұл функцияға қажет логиканы қосуды ұмытпа
    }

    public function forceDelete(User $user, Post $post)
    {
        // Бұл функцияға қажет логиканы қосуды ұмытпа
    }
}
