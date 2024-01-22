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
}
