<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table='offers';
    protected $fillable=['name','price','photo','details','created_at','updated_at','status'];
    protected $hidden=['created_at','updated_at'];
    public $timestamps=false;


    //local scopes
    public function scopeInactive($query){
        return $query->where('status',0);

    }

    public function scopeInvalid($query){
        return $query->where('status',0)->whereNull('details');

    }

    //register global scope
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }

    //mutators
    public function setNameAttribute($val){
        $this->attributes['name']=strtoupper($val);
    }
}
