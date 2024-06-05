<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobile extends Model
{
    use HasFactory;

    protected $table='mobile';
    protected $fillable=['code','phone','user_id'];
    protected $hidden=['user_id'];
    public $timestamps=false;

    //relations
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
