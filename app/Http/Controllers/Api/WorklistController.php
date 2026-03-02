<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class WorklistController extends Controller
{
    //
    public function query(Request $request)
    {
        $patientId = $request->query('patient_id');

        if (!$patientId) {
            return response()->json([
                'code' => 0,
                'message' => 'patient_id is required',
                'data' => null
            ], 400);
        }

        $patient = Patient::where('id', $patientId)->first();

        if (!$patient) {
            return response()->json([
                'code' => 0,
                'message' => 'Patient not found',
                'data' => null
            ]);
        }

        return response()->json([
            'code' => 1,
            'message' => '',
            'data' => [
                'SerialNo' => 'ACC-' . $patient->id,
                'PatientID' => (string) $patient->id,
                'PatientName' => $patient->name,
                'PatientSex' => $patient->gender,
                'PatientAge' => $patient->age,
                'PatientBirthDate' => null,
                'RequestDepartment' => 'CARDIO',
                'RequestID' => 'REQ-' . $patient->id,
                'SickBedNo' => 'BED-01',
                'Pacemaker' => $patient->pacemaker ? '1' : '2',
                'ExamDepartment' => 'ECG',
                'Priority' => 'NORMAL',
                'fileGuid' => 'GUID-' . $patient->id,
                'RequestDate' => now()->format('Ymd'),
            ]
        ]);
    }
}
