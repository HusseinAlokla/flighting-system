<?php

namespace App\Http\Controllers;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PassengerController extends Controller
{
    public function index(Request $request){
    $passengers = QueryBuilder::for(Passenger::class)
        ->with('flights') 
        ->whereHas('flights', function ($query) use ($request) {
            // Example conditional filter on the flights relationship
            if ($request->has('flightName')) {
                $query->where('name', $request->input('flightName'));
            }
        })
        ->allowedFilters(['FirstName', 'LastName', 'email', 'DOB', 'passport_expiry_date'])
        ->allowedSorts(['FirstName', 'LastName', 'email', 'DOB', 'passport_expiry_date'])
        ->paginate($request->input('per_page', 10));

    return response(['success' => true, 'data' => $passengers]);
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers',
            'password' => 'required|string|min:8',
            'DOB' => 'required|date',
            'passport_expiry_date' => 'required|date',
            
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $passenger = Passenger::create($validatedData);

        return response()->json($passenger, 201);
    }

    
    public function show(Passenger $passenger)
    {
        return response()->json($passenger);
    }

    public function update(Request $request, Passenger $passenger)
    {
        $validatedData = $request->validate([
            'FirstName' => 'string|max:255',
            'LastName' => 'string|max:255',
            'email' => 'string|email|max:255|unique:passengers,email,' . $passenger->id,
            'DOB' => 'date',
            'passport_expiry_date' => 'date',
            'flight_id' => 'nullable|exists:flights,id',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        $passenger->update($validatedData);

        return response()->json($passenger);
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();
        return response(['success' => true, 'data' => $passenger]);
    }

}
