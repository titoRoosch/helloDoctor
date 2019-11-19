<?php

namespace App\Http\Controllers;

use App\Traits\TraitDoctor;
use App\Traits\TraitSpecialties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    use TraitDoctor, TraitSpecialties;

    /**
     * Function to Redirect to the Edit Doctor Page
     * with the id of the Doctor that will be edited
     */
    public function viewConfigure($id)
    {
        return view('doctor/edit',[
            'doctorId' => $id
        ]); 
    }

    /**
     * Function to retrieve all of the doctors and it's specialties
     */
    public function listDoctors()
    {
        return $this->listDoctorsTrait();
    }

    /**
     * Function to retrieve the data of one specific Doctor 
     * based on the Id
     */
    public function doctorDetails($id)
    {
        return $this->doctorDetailsTrait($id);
    }

    /**
     * Function to retrieve the data of the doctors that contains the required name
     */
    public function getDoctorByName(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name'              => 'required|string', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 405);            
        }

        return $this->getDoctorByNameTrait($request);
    }

    /**
     * Function to retrieve the data of one specific Doctor 
     * based on the CRM
     */
    public function getDoctorByCrm($crm)
    {
        return $this->getDoctorByCrmTrait($crm);
    }

    /**
     * Function to Insert a New Doctor on the database
     * if the required fields are present the new doctor will be inserted
     */
    public function insertDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name'              => 'required|string', 
            'telephone'         => 'required|string', 
            'crm'               => 'required|integer',
            'specialties'       => 'required|array',
        ]);
        if ($validator->fails()) { 
            return response()->json($validator->errors(), 405);            
        }

        $validatorSecond = Validator::make($request->specialties, [ 
            'specialties.*.id'              => 'required|integer|exists:specialties,id', 
        ]);

        if ($validatorSecond->fails()) { 
            return response()->json(['error'=>$validatorSecond->errors()], 405);            
        }

        return $this->insertDoctorTrait($request);
    }

    /**
     * Function to delete a Doctor based on the Id
     */
    public function deleteDoctor($id)
    {
        $this->deleteDoctorTrait($id);
    }

    /**
     * Function to update a existing Doctor on the database
     * The CRM field cannot be changed
     */
    public function updateDoctor(Request $request, $doctor_id)
    {
        $validator = Validator::make($request->all(), [ 
          //  'id'       => 'required|integer|exists:doctor,id',
            'name'              => 'required|string', 
            'telephone'         => 'required|string', 
          //  'crm'               => 'required|integer',
            'specialties'       => 'required|array',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 405);            
        }

        return $this->updateDoctorTrait($request, $doctor_id);
    }
}
