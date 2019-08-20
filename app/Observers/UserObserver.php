<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    public function saving (User $user)
    {
        // 只有头像为空时才给设置默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'http://dingyue.ws.126.net/e=cCUYs7IAZsGJEQTicVaHw8NpeCO4NEjfzA6S8YOelUI1553444607133.jpg';
        }
    }
}