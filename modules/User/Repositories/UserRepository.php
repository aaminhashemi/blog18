<?php


namespace User\Repositories;


use User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function saveUser($request)
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)
        ]);
    }

    public function allUsers()
    {
        return User::all();
    }

    public function revokeToken()
    {
        auth()->user()->tokens()->delete();
    }

    public function findUserByEmail($request)
    {
        return User::where('email', $request->email)->first();
    }

    public function hashCheck($request,$user)
    {
        return Hash::check($request->password, $user->password);
    }
}
