<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DoctorService;

class DoctorsAPIController extends Controller
{
    protected $DoctorService;
    public function __construct(doctorService $DoctorService)
    {
        $this->DoctorService = $DoctorService;
    }
    public function index()
    {
        $data = $this->DoctorService->getAlldoctors();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        $response = $this->DoctorService->createdoctor($request);
        return response()->json($response);
    }
    public function edit(Request $request)
    {
        $response = $this->DoctorService->editdoctor($request->id);
        return response()->json($response);
    }
    public function update(Request $request)
    {
        $response = $this->DoctorService->updatedoctor($request);
        return response()->json($response);
    }
    public function destroy($id)
    {
        $response = $this->DoctorService->deleteDoctor($id);
        return response()->json($response);
    }
}
