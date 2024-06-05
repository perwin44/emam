<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Offer;
use Illuminate\Http\Request;

class CollectTutorial extends Controller
{
    //
    public function index(){

        // $numbers=[1,2,3,4];
        // $col=collect($numbers);

        //$col->avg();
        // return $col->avg();

        // $names=collect(['name','age']);
        // $res=$names->combine(['ahmed','28']);

        // return $res;

        //name=>ahmed age=>28

        // $ages=collect([1,2,3,4,5,6,7,9]);
        // return $ages->count();
        // if($ages->count()>0){

        // }

        // $ages=collect([1,2,3,4,4,6,7,7]);
        // return $ages->countBy();

        $ages=collect([1,2,3,5,5,6,7,9]);
         return $ages->duplicates();

         //each
         //filter
         //search
         //transform

    }

    public function complex(){
         $offers=Doctor::get();

        //remove
        $offers->each(function($doc){
            if($doc->id==4){
            unset($doc->title);
            }
            $doc->title='specialist';
            return $doc;
        });
        return $offers;

        //add
    }

    public function complexFilter(){
        $offers=Offer::get();
        $offers=collect($offers);
        $res=$offers->filter(function($value,$key){
            return $value['photo']=='';

        });
        return array_values($res->all());
    }

    public function complexTransform(){
        $offers=Offer::get();
        $offers=collect($offers);
        return $res=$offers->transform(function($value,$key){

            $data=[];
            $data['name']=$value['name'];
            $data['age']=30;
            return $data;
            //return 'name is : ' . $value['name'];
        });
    }
}
