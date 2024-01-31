<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

        // Filtering
        if ($request->has('departure_airport')) {
            $query->where('departure_airport', 'like', '%' . $request->input('departure_airport') . '%');
        }

        if ($request->has('arrival_airport')) {
            $query->where('arrival_airport', 'like', '%' . $request->input('arrival_airport') . '%');
        }

        if ($request->has('flight_number')) {
            $query->where('flight_number', 'like', '%' . $request->input('flight_number') . '%');
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortField = $request->input('sort_by');
            $sortOrder = $request->input('sort_order', 'asc');
            $query->orderBy($sortField, $sortOrder);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $flights = $query->paginate($perPage);

        if ($flights->isEmpty()) {
            return response()->json(['status' => 404, 'message' => 'No flights found'], 404);
        }

        return response()->json(['status' => 200, 'flights' => $flights], 200);
    }
}
