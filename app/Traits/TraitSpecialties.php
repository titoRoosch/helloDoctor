<?php

namespace App\Traits;

use App\Models\Specialties;

trait TraitSpecialties
{
    public function listSpecialtiesTrait()
    {
        return Specialties::all();
    }

    public function specialtyDetailsTrait($id)
    {
        return Specialties::find($id);
    }

    public function insertSpecialtieTrait($specialtyReq)
    {
        try{
            return Specialties::firstOrCreate(['name' => $specialtyReq->name]);
        }catch(\Exception $err){
            return $err->getMessage();
        }
    }

    public function getSpecialtiesByNameTrait($specialtyReq)
    {
        return Specialties::where([
            ['name', 'like',"%$specialtyReq->name%"]
        ])->get();
    }

    public function deleteSpecialtieTrait($id)
    {
        try{
            $specialty = Specialties::find($id);
            $specialty->delete();
        }catch(\Exception $err){
            return $err->getMessage();
        }
    }

    public function updateSpecialtieTrait($specialtyReq)
    {
        try{
            $specialty = Specialties::find($specialtyReq->id);
            $specialty->name  = $specialtyReq->name;
            $specialty->save();
            return $specialty;
        }catch(\Exception $err){
            return $err->getMessage();
        }
    }

    public function validateSpecialtiesTrait($specialties)
    {
        $validate = true;
        $notFoundSpecialty = [];
        $message = "";
        if(count($specialties) < 2){
            $ret = [
                'validate' => false,
                'notFound' => $notFoundSpecialty,
                'message' => "Minimum of two specialties required"
            ];
            return json_encode($ret);
        }
        foreach($specialties as $specialty){
            if(!Specialties::where([
                ['id', $specialty['id']]
            ])->exists()){
                $validate = false;
                $notFoundSpecialty[] = $specialty;
                $message = "Specialties not found";
            }
        }

        $ret = [
            'validate' => $validate,
            'message' => $message,
        ];

        return json_encode($ret);
    }
}
