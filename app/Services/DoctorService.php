<?php
namespace App\Services;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
class doctorService
{
    /**
     * Get all doctors.
     */
    public function getAlldoctors()
    {
        return doctor::all();
    }
    /**
     * Create a new doctor.
     */
    public function createdoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:doctors',
            'phone' => 'required',
        ]);
        try {
            doctor::create($request->all());
            return ['success' => true, 'message' => 'doctor created successfully!'];
        } catch (\Exception $e) {
            Log::error('doctor creation failed: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }
    /**
     * Edit a new doctor.
     */
    public function editdoctor($id)
    {
        return  doctor::findOrFail($id);
    }
    /**
     * Update a doctor's information.
     */
    public function updatedoctor(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:255',
            Rule::unique('doctors')->ignore($request->id),
            'phone' => 'required',
        ]);
        $doctor = doctor::findOrFail($request->id);
        if ($doctor) {
            try {
                $doctor->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'specialty' => $request->specialty,
                ]);
                return ['success' => true, 'message' => 'doctor updated successfully!'];
            } catch (\Exception $e) {
                Log::error('Update Failed. ' . $e->getMessage());
                return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
            }
        }
        return ['success' => false, 'message' => 'Invalid doctor ID'];
    }
    /**
     * Delete a doctor.
     */
    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        try {
            $doctor->delete();
            return ['success' => true, 'message' => 'doctor deleted successfully!'];
        } catch (\Exception $e) {
            Log::error('Delete operation failed. ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }
}
