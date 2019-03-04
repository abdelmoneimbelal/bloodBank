<?php

namespace App\Http\Controllers\Api;

use App\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Client;
use App\Order;
use App\governrates;
use Illuminate\Validation\Rule;
use Validator;
use bloodType;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
//use App\BloodType;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = validator()->make($request->all(),[

            'name' => 'required',
            'city_id' => 'required',
            'phone' => 'required',
            'last_date_donate' => 'required',
            'blood_type_id' => 'required|exists:blood_types,id',
            'password' => 'required|confirmed',
            'email' => 'required|unique:clients',
        ]);

        if($validator->fails())
        {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $request->merge(['password' =>bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->save();
        $client->governrate()->attach($request->governrate_id);
        //$bloodType = bloodType::where('name', $request->blood_type)->first();
        //$client->bloodType()->attach($bloodType->id);
        return responseJson(1,'تم الاضافة بنجاح',[
            'api_token' => $client->api_token,
            'client' => $client]);

    }
    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),[

            'phone' => 'required',
            'password' => 'required',

        ]);

        if($validator->fails())
        {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        //$auth = auth()->guard('api')->validator($request->all());
        $client = client::where('phone',$request->phone)->first();
        if ($client)
        {
            if (Hash::check($request->password,$client->password))
            {
                return responseJson(1,'تم نسجيل الدخول',[
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else {
                return responseJson(0,'بيانات الدخول غير صحيحة');
            }
        } else {
            return responseJson(0,'بيانات الدخول غير صحيحة');
        }

    }

    public function profile(Request $request)
    {
        $validation = validator()->make($request->all(),[
           'password' => 'confirmed',
           'email' => Rule::unique('clients')->ignore($request->user()->id),
           'phone' => Rule::unique('clients')->ignore($request->user()->id),
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(),$data);
        }

        $loginUser = $request->user();
        $loginUser->update($request->all());

        if ($request->has('password')) {
            $loginUser->password = bcrypt($request->password);
        }

        $loginUser->save();

        if ($request->has('governrate_id')) {
            $loginUser->governrates()->detach($request->governrate_id);
            $loginUser->governrates()->attach($request->governrate_id);
        }

      /*  if ($request->has('blood_type')) {
                $bloodType = BloodTgype::where('name',$request->blood_type);
                $loginUser->bloodType()->detach($bloodType->id);
                $loginUser->bloodType()->attach($bloodType->id);
            }*/

            $data = [
                'user' => $request->user()->fresh()
            ];

            return responseJson(1,'تم تحديث البيانات',$data);
        }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'phone' => 'required',
        ]);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(), $data);
        }
        $user = Client::where('phone',$request->phone)->first();
        if($user)
        {
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if($update)
            {
                // smsMiser($request->phone,"your reset code is :".$code);
                //send email
                Mail::to($user->email)
                    // ->cc($moreUsers)
                    ->bcc("abdobelal271@yahoo.com")
                    ->send(new ResetPassword($user));

                return responseJson(1 , 'برجاء فحص هاتفك' ,
                    [
                        'pen_code_for_test' => $code,

                    ]);
            }
            else{
                return responseJson(0 , 'حاول مره اخري');
            }
        }
        else{
            return responseJson(0,'حاول مره اخرى');
        }
    }
    public function password(Request $request){
        $validator = validator::make($request->all() , [

            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0, $validator->errors()->first(),$data);

        }

        $user = Client::where('pin_code',$request->pin_code)->where('pin_code' ,'!=' ,0)->first();
        if($user)
        {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;
            if($user->save()){
                return responseJson(1 , 'تم تغيير كلمه المرور بنجاح');
            }else{
                return responseJson(0 , 'حدث خطا مره اخري');
            }
        }
        else{
            return responseJson(0 ,'هذا الكود غير صالح');

        }
    }

      public function registerToken (Request $request)
      {
          $validation = validator()->make($request->all(),[
              'token' => 'required',
              'type' => 'required|in:android,ios',
          ]);

          if ($validation->fails()) {
              $data = $validation->errors();
              return responseJson(0, $validation->errors()->first(), $data);
          }

          Token::where('token', $request->token)->delete();
          $request->user()->tokens()->create($request->all());
          return responseJson(1, 'تم التسجيل بنجاح');
      }

      public function removeToken (Request $request)
      {
          $validation = validator()->make($request->all(),[
              'token' => 'required',
          ]);

          if ($validation->fails()) {
              $data = $validation->errors();
              return responseJson(0, $validation->errors()->first(), $data);
          }

          Token::where('token', $request->token)->delete();
          return responseJson('token', 'تم الحذف بنجاح');
      }
}
