<?php

namespace App\Http\Controllers;

use App\Traits\TraitSpecialties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialtiesController extends Controller
{
    use TraitSpecialties;

    public function viewConfigure($id)
    {
        return view('specialties/edit',[
            'specialtyId' => $id
        ]); 
    }

    public function specialtyDetails($id)
    {
        return $this->specialtyDetailsTrait($id);
    }

    public function listSpecialties()
    {
        return $this->listSpecialtiesTrait();
    }

    public function getSpecialtiesByName(Request $request)
    {
        return $this->getSpecialtiesByNameTrait($request);
    }

    public function insertSpecialtie(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name'              => 'required|string', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        return $this->insertSpecialtieTrait($request);
    }

    public function deleteSpecialtie($id)
    {
        return $this->deleteSpecialtieTrait($id);
    }

    public function updateSpecialtie(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name'             => 'required|string', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        return $this->updateSpecialtieTrait($request);
    }
}
