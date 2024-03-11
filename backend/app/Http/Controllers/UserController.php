<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index() {
        $users = User::getUsers();
        return response()->json($users, 200);
    }

    public function show($id)   {
        $user = User::findUser($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }
    public function findUser(Request $request)  {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user && password_verify($request->input('password'), $user->password)) {
            return response()->json(['email' => $user->email, 'password' => $request->input('password'), 'id' => $user->id], 200);
        } else {
            return response()->json(['message' => 'User not found or incorrect password'], 404);
        }
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json($user, 201);
    }
}

