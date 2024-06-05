<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table='doctors';
    protected $fillable=['name','title','hospital_id','medical_id','created_at','updated_at'];
    protected $hidden=['created_at','updated_at','pivot'];
    public $timestamps=true;

    public function hospital(){
        return $this->belongsTo(Hospital::class,'hospital_id','id');
    }

    public function services(){
        return $this->belongsToMany(Service::class,'doctor_service','doctor_id','service_id','id','id');
    }

    //accessors
    public function getGenderAttribute($val){
        return $val==1 ?'male':'female';
    }

    //mutators
    

}
