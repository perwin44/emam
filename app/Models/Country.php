<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table='countries';
    protected $fillable=['name'];
    //protected $hidden=['created_at','updated_at','pivot'];
    public $timestamps=false;

    public function doctors(){
        return $this->hasManyThrough('App\Models\Doctor','App\Models\Hospital','country_id','hospital_id','id','id');
        
    }

}
