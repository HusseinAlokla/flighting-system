<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelUnit;
class ModelUnitController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('add model unit');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        $modelUnit = ModelUnit::create($validatedData);

        return response(['success' => true, 'data' => $modelUnit]);
    }

   
    public function update(Request $request, $id)
    {
        $this->authorize('edit model unit');

        $modelUnit = ModelUnit::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        $modelUnit->update($validatedData);

        return response(['success' => true, 'data' => $modelUnit]);
    }

    // Delete a model unit
    public function destroy($id)
    {
        $this->authorize('delete model unit');

        $modelUnit = ModelUnit::findOrFail($id); 

        $modelUnit->delete();

        return response(['success' => true, 'data' => $modelUnit]);
    }
}
