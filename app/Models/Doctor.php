<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";

    protected $fillable = [
        'name',
        'crm',
        'telephone'
    ];

    public function specialties()
    {
        return $this->hasMany(DoctorSpecialties::class, 'doctor_id', 'id');
    }
}
