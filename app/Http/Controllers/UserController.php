<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

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
    public function create()
    {

        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

        ]);

        $user = User::create($data);
        return response(['success' => true, 'data' => $users]);
        //return redirect()->route('users.index');
    }

    public function show(User $user)
    {

       
        return response(['success' => true, 'data' => $users]);
    }

    public function edit(User $user)
    {

        //return view('users.edit', compact('user'));
        return response(['success' => true, 'data' => $users]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,

        ]);

        $user->update($request->all());

        return response(['success' => true, 'data' => $users]);
    }

    public function destroy(User $user)
    {

        
        $user->delete();
        return response(['success' => true, 'data' => $users]);
    }





}
