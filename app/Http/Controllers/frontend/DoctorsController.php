<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function index()
    {
        return view('frontend.doctors');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            // Search for doctors by name or specialization
            $doctors = Doctor::where('name', 'LIKE', "%{$query}%")
                ->orWhere('specialty', 'LIKE', "%{$query}%")
                ->get();

            // Return the results as JSON
            return response()->json($doctors);
        }

        return response()->json([]);
    }
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id); // Fetch the doctor
        return view('doctors.show', compact('doctor')); // Pass the data to a Blade view
    }
}
