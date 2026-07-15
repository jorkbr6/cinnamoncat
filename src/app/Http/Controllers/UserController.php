<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function getAll()
    {
        $users = User::query()->latest()->get();

        return view('user', compact('users'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        try {
            $this->userService->createUser($validated);

            return redirect()->route('cinnamon.index')->with('status', 'A new cinnamon friend was added.');
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'email' => 'We could not create that cinnamon friend right now. Please try again.',
            ])->onlyInput('name', 'email');
        }
    }
}
