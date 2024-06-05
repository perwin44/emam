<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    protected $table='medicals';
    protected $fillable=['pdf','patient_id',];
    //protected $hidden=['created_at','updated_at','pivot'];
    public $timestamps=false;
}
