<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Models\Video;
use App\Models\Offer;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
//use App\Scopes\OfferScope;

class CrudController extends Controller
{
    //

    use OfferTrait;

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


        $file_name=$this->saveImage($request->photo,'images/offers');


       // insert;
        Offer::create([
            'photo'=>$file_name,
            'name'=> $request->name,
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
        // $offers=Offer::select('id','price','name','details')->get();
        // return view('offers.all',compact('offers'));

        //paginate result
        $offers=Offer::select('id','price','name','details')->paginate(PAGINATION_COUNT);
        //return view('offers.all',compact('offers'));
        return view('offers.paginations',compact('offers'));
    }

    public function editOffer($offer_id){
        //Offer::findOrFail($offer_id);
        $offer=Offer::find($offer_id);

        if(!$offer)
        return redirect()->back();

        $offer=Offer::select('id','name','details','price')->find($offer_id);

        return view('offers.edit',compact('offer'));

        //return $offer_id;
    }

    public function delete($offer_id){
        //check if offer id exists
        $offer=Offer::find($offer_id);// Offer::where('id','','$offer_id')->first();
        if(!$offer)
        return redirect()->back()->with(['error'=>('offer not exist')]);
        //withError

        $offer->delete();

        return redirect()->route('offers.all')->with(['success'=>('deleted successfully')]);

    }

    public function updateOffer(OfferRequest $request,$offer_id){
        //validate

        //check
        $offer=Offer::find($offer_id);
        if(!$offer)
        return redirect()->back();


        //update
        $offer->update($request->all());

        return redirect()->back()->with(['success'=>'updated done']);

        // $offer->update([
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        // ]);

    }

    public function getVideo(){

        $video=Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video',$video);
    }

    public function getAllInactiveOffers(){

        //where whereNull whereNotNull whereIn
        //Offer::whereNotNull('details')->get();

        //return $inactiveOffers=Offer::where('status',0)->get();//all inactive offers
        //return $inactiveOffers=Offer::inactive()->get();//all inactive offers

        //global scope
        //return $inactiveOffers=Offer::get();//all inactive offers

        //how to remove global scope
        return $offer=Offer::withoutGlobalScopes([OfferScope::class])->get();
    }

}
// ,'name_'.LaravelLocalization::getSupportedLanguagesKeys().' as name','details_'.LaravelLocalization::getSupportedLanguagesKeys().' as details'
