<?php
namespace App\Http\Controllers\Front;

//use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
//use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Controller ;
class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function showUserName(){
        return 'ahmed';
    }
    public function getIndex(){
        $data=[];
        $data['id']=5;
        $data['name']='ahmed';

        $obj=new \stdClass();
        $obj->id=5;
        $obj->name='ahmed';
        $obj->gender='male';

        $data=['ahmed','bassem'];
        return view('welcome',compact('data'));

    }
}
