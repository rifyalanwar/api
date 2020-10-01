<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return[
            'id'            => $user->id,
            'id_member'     => $user->id_member,
            'id_upline'     => $user->id_upline,
            'username'      => $user->username,
            'nama'          => $user->nama,
            'nomer_hp'      => $user->nomer_hp,
            'alamat'        => $user->alamat,
            'token'         => $user->token,
            'registered'    => $user->created_at->diffForHumans(),
        ];
    }
}