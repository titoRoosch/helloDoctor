<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorSpecialties extends Model
{
    protected $table = "doctor_specialties";

    protected $fillable = [
        'specialty_id',
        'doctor_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'specialty_id',
        'doctor_id',
    ];

    public function specialty()
    {
        return $this->hasOne(Specialties::class, 'id', 'specialty_id');
    }
}
