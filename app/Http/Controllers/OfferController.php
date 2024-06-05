<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    use OfferTrait;
    public function create(){
        //view form to add this offer
        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request){
        //save offer into DB using AJAX
        $file_name=$this->saveImage($request->photo,'images/offers');


        // insert table offers in database;
        $offer=Offer::create([
            'photo'=>$file_name,
            'name'=>$request->name,
            'price'=>$request->price,
            'details'=>$request->details,
        ]);

        if($offer)
        return response()->json([
            'status'=>true,
            'msg'=>'saved successfully',
        ]);

        else
        return response()->json([
            'status'=>false,
            'msg'=>'error in saving',
        ]);
    }

    public function all(){
         $offers=Offer::select('id','price','name','details')->limit(10)->get();
        return view('ajaxoffers.all',compact('offers'));
    }

    public function delete(Request $request){
        $offer=Offer::find($request->id);// Offer::where('id','','$offer_id')->first();
        if(!$offer)
        return redirect()->back()->with(['error'=>('offer not exist')]);
        //withError

        $offer->delete();
        return response()->json([
            'status'=>true,
            'msg'=>'deleted completely',
            'id'=>$request->id,
        ]);
    }

    public function edit(Request $request){
        //Offer::findOrFail($offer_id);
        $offer=Offer::find($request->offer_id);

        if(!$offer)
        return response()->json([
            'status'=>false,
            'msg'=>'this offer is not exist',
        ]);

        $offer=Offer::select('id','name','details','price')->find($request->offer_id);

        return view('ajaxoffers.edit',compact('offer'));

        //return $offer_id;
    }

    public function update(Request $request){
          //check
          $offer=Offer::find($request->offer_id);
          if(!$offer)
          return response()->json([
            'status'=>false,
            'msg'=>'this offer is not exist',
        ]);


          //update
          $offer->update($request->all());

        //   update([
        //     'name'=>$request ->name,
        //     'details'=>$request ->details,
        //     'price'=>$request->price,
        //   ]);

        return response()->json([
            'status'=>true,
            'msg'=>'this offer is updated',
        ]);
    }
}
