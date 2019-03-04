<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governrate;
use App\City;
use App\Article;
use App\Category;
use App\setting;
use App\Order;
use App\Token;
class MainController extends Controller
{
    /*public function articles()
    {

        $articles = Article::with('Category')->paginate(10);

        return responseJson(1,'success',$articles);

    }*/

    public function governrates(){

        $governrates = Governrate::all();

        return responseJson(1,'success',$governrates);

    }


    public function cities(Request $request)
    {

        $cities = City::where(function($query)use($request){
            if($request->has('governrate_id'))
            {

                $query->where('governrate_id',$request->governrate_id);
            }
        })->get();
        return responseJson(1,'success',$cities);

    }

    public function categories()
    {
        $categories = Category::all();

        return responseJson(1,'success',$categories);
    }

    public function articles(Request $request){

        $articles = Article::where(function($query)use($request){
            if($request->has('category_id'))
            {

               $query->where('category_id',$request->category_id);
            }
        })->get();
        return responseJson(1,'success',$articles);

      }

      //favouritePost'
 public function favouriteposts(Request $request){

    // RequestLog::create(['content' => $request->all(),'service' => 'post toggle favourite']);
    $validator = [
        'article_id' => 'required|exists:articles,id',
    ];
    $validator = validator()->make($request->all(),$validator);
    if ($validator->fails())
    {
        return responseJson(0,$validator->errors()->first(),$validator->errors());
    }
    // return $request->user()->favourites;

    $toggle = $request->user()->favourites()->toggle($request->article_id);// attach() detach() sync() toggle()
    // [1,2,4] - sync(2,5,7) -> [1,2,4,5,7]
    // detach()
    // attach([2,5,7])
    return responseJson(1,'Success',$toggle);
}

 //myFavourite
 public function myfavourites(Request $request){

    $articles = $request->user()->favourites()->latest()->paginate(20);//oldest()
    return responseJson(1 ,'Load.......' ,$articles);
 }

 public function setting(){

    $setting = Setting::all();

    return responseJson(1,'success',$setting);

   }

    public function creatorder(Request $request)
    {

        $validator = validator()->make($request->all(),[

            'name' => 'required',
            'age' => 'required',
            'blood_type_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'hospital_name' => 'required',
            'number_ofbage_requierd' => 'required',
            'latitude' => 'required',
            'longtude' => 'required',
            'detailes' => 'required',
            //'client_id' => 'required',
        ]);

        if($validator->fails())
        {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            $order = $request->user()->orders()->create($request->all());

            //find clients suitable for this order request
            $clientsIds = $order->city->governrate->clients()->whereHas('bloodType', function ($q) use ($request, $order) {
               $q->where('blood_types.id', $order->blood_type_id);
           })->pluck('clients.id')->toArray();

            $send = "";
           if (count($clientsIds)) {

               // create a notification on database
               $notification = $order->notification()->create([
                    'title' => 'يوجد حالة تبرع قريبة منك',
                    'content' => $order->blood_types . 'احتاج متبرع لفصيلة'
               ]);

               // attach clients to this notification
               $notification->clients()->attach($clientsIds);

               $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
               //dd($tokens);

               if (count($tokens))
               {
                   public_path();
                   $title = $notification->title;
                   $body = $notification->content;
                   $data = [
                       'order_id' => $order->id
                   ];
                   $send = notifyByFirebase($title, $body, $tokens, $data);
                   info("firebase result: " . $send);
//                info("data: " . json_encode($data));
               }
           }

            return responseJson(1,'تم اضافة طلبك', compact('order'));
        }

        /*
         $order = Order::create($request->all());
         $order->save();

        $data = [
            'user' => $request->user()->fresh()
        ];
        return responseJson(1,'done',$data);
    */


    }

    public function showorder(Request $request)
    {
        $order = Order::all();

        return responseJson(1,'success',$order);

    }

    public function orderrequest(Request $request)
    {
        $orders = Order::where(function($query)use($request){
            if($request->has('client_id'))
            {

                $query->where('client_id',$request->client_id);
            }
        })->get();
        return responseJson(1,'success',$orders);

    }


}



