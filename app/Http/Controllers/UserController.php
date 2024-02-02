<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Flight;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function deleteUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->delete();
            // Optionally, you can redirect or return a response here
        }

        // Handle the case where the user is not found
        // Redirect or return a response accordingly
    }
    public function index(Request $request)
    {




        $query = User::query();

        // Filtering
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortField = $request->input('sort_by');
            $sortOrder = $request->input('sort_order', 'asc');
            $query->orderBy($sortField, $sortOrder);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage);

        if ($users->isEmpty()) {
            return response()->json(['status' => 404, 'message' => 'No records found'], 404);
        }

        return response()->json(['status' => 200, 'users' => $users], 200);
    }
    public function create()
    {
        // Show form to create a new user
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            // Add more validation rules as needed
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        // Show a specific user
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Show form to edit a user
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Add more validation rules as needed
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        // Delete a user
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }





}
