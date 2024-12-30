<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

use function Laravel\Prompts\info;

class AdminController extends Controller
{
    // Display the dashboard with CRUD operations
    public function index()
    {
        $doctors = doctor::all();
        return view('admin.doctors.admin_dashboard', compact('doctors'));
    }

    // Store a new doctor in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        $imagePath = $request->file('image') ? $request->file('image')->store('doctors', 'public') : null;

        // Create doctor
        Doctor::create([
            'name' => $request->name,
            'specialty' => $request->specialty,
            'phone_number' => $request->phone_number,
            'email' => $request->email
        ]);

        // 'image' => $imagePath,

        return redirect()->back()->with('success', 'Doctor added successfully!');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    // Update the doctor details
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctors', 'public');
            $doctor->image = $imagePath;
        }

        // Update doctor
        $doctor->update($request->only('name', 'specialty', 'phone_number', 'email'));

        return redirect('/admin/doctors')->with('success', 'Doctor updated successfully!');
    }

    // Delete a doctor
    public function destroy($id)
    {
        info('destroy called with id', $id);
        $doctor = doctor::findOrFail($id);
        $doctor->delete();

        return redirect('/admin/doctors')->with('success', 'doctor deleted successfully!');
    }
}
