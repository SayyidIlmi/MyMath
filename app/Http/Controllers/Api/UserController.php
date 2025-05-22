<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return response()->json($users);
    }

    
    public function show($id)
    {
        $user = $this->userService->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function store(Request $request)
    {
        try{
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            
        ]);
        $user = $this->userService->create($validated);
        return response()->json($user, 201);
    }catch(\Exception $e){
            return response()->json(['message' => 'Email may be already taken', 'errors' => $e->getMessage()], 400);
        }
 }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        $user = $this->userService->update($id, $validated);

        return response()->json($user);
    }

    
    public function destroy($id)
    {
        $this->userService->delete($id);

        return response()->json(['message' => 'User deleted successfully']);
    }


    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = $this->userService->login($validated['email'], $validated['password']);

            if (!$user) {
                return response()->json([
                    'message' => 'Email or Password may be incorrect'
                ], 401);
            }

            return response()->json([
                'message' => 'Login Sukses, Selamat datang ' . $user->name,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}