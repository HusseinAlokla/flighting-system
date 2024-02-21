<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters('name')
            ->allowedSorts('name')
            ->orderBy($request->input('sort_by', 'name'), $request->input('sort_order', 'asc'))
            ->paginate($request->input('per_page', 10));
             return response()->json(['success' => true, 'data' => $users]);
    }


    
    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,

        ]);

        $user->update($request->all());

        return response(['success' => true, 'data' => $user]);
    }

    public function destroy(User $user)
    {

        $user->delete();
        return response(['success' => true, 'data' => $user]);
    }
}
   






