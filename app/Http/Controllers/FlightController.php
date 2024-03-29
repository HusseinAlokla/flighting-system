<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Filters\FiltersExact;
use Spatie\QueryBuilder\QueryBuilder;

class FlightController extends Controller
{

    public function index(Request $request)
    {
        $flights = QueryBuilder::for(Flight::class)
            ->allowedFilters([AllowedFilter::exact('id'), 'departure_city', 'arrival_city', AllowedFilter::exact('passengers.id')])
            ->allowedSorts(['updated_at'])
            ->orderBy($request->input('sort_by', 'departure_city'), $request->input('sort_order', 'asc'))
            ->paginate($request->input('per_page', 10));

        return response(['success' => true, 'data' => $flights]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'departure_city' => 'required|string|max:255',
            'arrival_city' => 'required|string|max:255',
            'flight_number' => 'required|string|max:255',
        ]);

        $flight = Flight::create($validatedData);
        return response(['success' => true, 'data' => $flight]);
    }
    public function show(Flight $flight)
    {
        return response(['success' => true, 'data' => $flight]);
    }
    public function update(Request $request, Flight $flight)
    {
        $validatedData = $request->validate([
            'departure_city' => 'string|max:255',
            'arrival_city' => 'string|max:255',
            'flight_number' => 'string|max:255',

        ]);

        $flight->update($validatedData);
        return response(['success' => true, 'data' => $flight]);

    }
    public function destroy(Flight $flight)
    {

        $flight->delete();
        return response(['data' => $flight], Response::HTTP_NO_CONTENT);

    }
}