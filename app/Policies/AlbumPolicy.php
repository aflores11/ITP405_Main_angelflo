<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Album;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AlbumPolicy
{
    use HandlesAuthorization;

    public function create(User $user){
        if(Auth::check()){
            return true;
        }
        else return false;
    }

    public function edit(User $user, Album $album){
        return $user->id === $album->user->id;
    }
}
