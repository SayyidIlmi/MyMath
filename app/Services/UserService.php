<?php

namespace App\Services;
use App\Models\User;

class UserService
{
     public function getAll()
    {
        return User::all();
    }

    // Find user by ID
    public function find($id)
    {
        return User::find($id);
    }

    // Create new user
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => now(), 
            'password' => $data['password'],
        ]);
    }

    // Update user
    public function update($id, array $data)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'password' => $data['password'] ?? $user->password,
        ]);

        return $user;
    }

    // Delete user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
    // Login user
    public function login($email, $password)
    {
        // Login tanpa Hash
        return User::where('email', $email)
                    ->where('password', $password)
                    ->first();
    }
    

}