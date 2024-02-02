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
        // $query = User::all();
        // if ($query->count() > 0) {
        //     return response()->json([
        //         'status' => 200,
        //         'users' => $query
        //     ], 200);

        // } else {
        //     return response()->json([
        //         'status' => 404,
        //         'users' => 'No records found'
        //     ], 404);
        // }



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
        // Store a new user
        User::create($request->all());
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        // Show a specific user
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        // Show form to edit a user
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Update a user
        $user = User::findOrFail($id);
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
