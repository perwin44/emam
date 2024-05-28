<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    //

    public function getOffers(){
        return Offer::select('id','name')->get();
    }

   /* public function store(){
        Offer::create([
            'name'=>'offer3',
            'price'=>'5000',
            'details'=>'offer details',
        ]);
    }*/

    public function create(){
        return view('offers.create');
    }

    public function store(OfferRequest $request){
        // $rules=[
        //     'name'=>'required |max:100|unique:offers,name',
        //     'price'=>'required|numeric',
        //     'details'=>'required',
        // ];

        // $messages=$this->getMessages();
        // //validate

        // $validator=Validator::make($request->all(),$rules,$messages);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInputs($request->all());
        // }

       // insert;
        Offer::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details,
        ]);
        return redirect()->back()->with(['success'=>' تم اضافة العرض  بنجاح']);
    }

    // protected function getMessages(){
    //     return $messages=[
    //         'name.required'=>'اسم العرض مطلوب',
    //         'name.unique'=>'اسم العرض موجود',
    //         'price.numeric'=>'سعر العرض يجب ان يكون ارقام',
    //         'price.required'=>'السعر مطلوب',
    //         'details.required'=>'التفاصيل مطلوبة',
    //     ];
    // }

    public function getAlloffers(){
        $offers=offer::select('id','price','name_'.LaravelLocalization::getSupportedLanguagesKeys().' as name','details_'.LaravelLocalization::getSupportedLanguagesKeys().' as details')->get();
        return view('offers.all',compact('offers'));
    }
}
