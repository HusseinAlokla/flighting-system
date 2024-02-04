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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

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

        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,

        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return (['data' => $user, Response::HTTP_NO_CONTENT]);
    }





}
