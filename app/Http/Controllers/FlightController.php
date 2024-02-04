<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;


class FlightController extends Controller
{

    public function index(Request $request)
    {
        $flights = QueryBuilder::for(Flight::class)
            ->allowedFilters(['departure_airport', 'arrival_airport', 'flight_number'])
            ->allowedSorts(['departure_airport', 'arrival_airport', 'flight_number'])
            ->defaultSort('departure_airport')
            ->orderBy($request->input('sort_by', 'departure_airport'), $request->input('sort_order', 'asc')) // Sort by request parameters
            ->paginate($request->input('per_page', 10));

        return $flights;
    }




    public function passengersByFlight(Request $request, Flight $flight)
    {
        $passengers = QueryBuilder::for($flight->passengers()->getQuery())
            ->allowedFilters('first_name', 'last_name', 'email')
            ->allowedSorts('first_name', 'last_name', 'email')
            ->paginate($request->input('per_page', 10));

        return response()->json(['passengers' => $passengers], 200);
    }

}
