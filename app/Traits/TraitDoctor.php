<?php

namespace App\Traits;

use App\Models\Doctor;
use App\Models\DoctorSpecialties;

trait TraitDoctor
{
    public function listDoctorsTrait()
    {
        return Doctor::with('specialties.specialty')->get();
    }

    public function doctorDetailsTrait($doctorId)
    {
        return Doctor::with('specialties.specialty')->find($doctorId);
    }

    public function getDoctorByNameTrait($doctorReq)
    {
        return Doctor::where([
            ['name', 'like', "%$doctorReq->name%"]
        ])->with('specialties.specialty')->get();
    }

    public function getDoctorByCrmTrait($crm)
    {
        return Doctor::where([
            ['crm', '=', $crm]
        ])->with('specialties.specialty')->first();
    }

    /**
     * Function to Verify if there is already a Doctor with the same CRM
     * in the database
     */
    public function insertDoctorTrait($doctorReq)
    {
        $doctor = Doctor::where([
            ['crm', $doctorReq->crm]
        ]);

        if($doctor->exists()){
            return response()->json(['error'=>'Crm alredy used'], 405);
        }
        
        return $this->registerDoctor($doctorReq);
    }


    /**
     * Function to register a new Doctor
     * It will first validate the sended Specialties
     * Then Insert The Doctor
     * Create the Doctor-Specialties relationship
     * And finally return the Created Doctor With it's Specialties
     */
    public function registerDoctor($doctorReq)
    {
        $valSpecialties = json_decode($this->validateSpecialtiesTrait($doctorReq->specialties));
        if(!$valSpecialties->validate){
            return response()->json([
                'error'=> $valSpecialties->message,
                'specialties' => $valSpecialties->notFound,
            ], 404);  
        }
        try{
            $doctor = Doctor::create([
                'name' => $doctorReq->name,
                'crm' => $doctorReq->crm,
                'telephone' => $doctorReq->telephone,
            ]);
    
            $this->insertDoctorSpecialties($doctorReq, $doctor);
            return $this->doctorDetailsTrait($doctor->id);
        }catch(\Exception $err){
            return $err->getMessage();
        }
    }

    public function insertDoctorSpecialties($doctorReq, $doctor)
    {
        $validate = true;
        $error = [];
        foreach($doctorReq->specialties as $specialty){
            try{
                DoctorSpecialties::create([
                    'specialty_id' => $specialty['id'],
                    'doctor_id' => $doctor->id,
                ]);
            }catch(\Exception $err){
                $validate = false;
                $error[] = $err->getMessage();
            }
        }
    }
    
    public function deleteDoctorTrait($id)
    {
        Doctor::find($id)->delete();   
    }
    
    public function updateDoctorTrait($doctorReq, $doctor_id)
    {
        $valSpecialties = json_decode($this->validateSpecialtiesTrait($doctorReq->specialties));
        if(!$valSpecialties->validate){
            return response()->json([
                'error'=> $valSpecialties->message,
                'specialties' => $valSpecialties->notFound,
            ], 404);  
        }
        try{
            $doctor = Doctor::find($doctor_id);
            $doctor->name = $doctorReq->name;
            $doctor->telephone = $doctorReq->telephone;
            $doctor->save();
            DoctorSpecialties::where([
                ['doctor_id', $doctor->id]
            ])->delete();
    
            $this->insertDoctorSpecialties($doctorReq, $doctor);
            return $this->doctorDetailsTrait($doctor_id);
        }catch(\Exception $err){
            return $err->getMessage();
        }
    }
}
