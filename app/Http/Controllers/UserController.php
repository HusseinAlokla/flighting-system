<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
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

}
