<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCoupon;
use App\Models\Deal;
use App\Mail\CouponMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    public function userCoupons(Request $request)
    {
        // return $request->all();

        if(auth()->user())
        {   
            $user_id = auth()->user()->id;
            
            if ($request->ajax()) {

                if( isset($request->email))
                {
                    $check = UserCoupon::where('deal_id',$request->dealid)->where('user_id',$user_id)->first();
                    if($check !=null && $check->email = $request->email)
                    {
                        return response()->json([
                            'message' =>'Coupon Already Sended On Mail.',
                        ]);
                    }
                    else
                    {
                        $deal = Deal::where('id',$request->dealid)->first();                    
                        $new  = new UserCoupon;
                        $new->deal_id = $request->dealid;
                        $new->user_id = $user_id;
                        $new->status = 0;
                        $new->email = $request->email;
                        $new->save();
                        // return $deal;
                        $nxt =  Carbon::createFromFormat('Y-m-d H:i:s', $new->created_at);
                        // return $nxt; 
                        // return date_format($nxt->addDays(1),"Y-m-d H:i:s");
                        $data = array(
                            'subject' => 'Sending Coupon.',
                            'id' => $deal->id,
                            'location' => $deal->location,
                            'picture_url' => $deal->picture_url,
                            'name' => $deal->name,
                            'views' => $deal->views,
                            'expiry' => date_format($nxt->addDays(1),"Y-m-d H:i:s")
                        );
                        // $email = 'shahzadanouman@hotmail.com';
                        Mail::to($request->email)->send(new CouponMail($data));

                        return response()->json([
                            'message' =>'Coupon Added Successfully!',
                            // 'message' =>$request->email,
                        ]);    
                        }
                        
                }

                if( isset($request->phone))
                {
                    $check = UserCoupon::where('deal_id',$request->dealid)->where('user_id',$user_id)->first();
                    if($check !=null && $check->phone = $request->phone)
                    {
                        return response()->json([
                            'message' =>'Coupon Already Texted.',
                        ]);
                    }
                    else
                    {
                        $deal = Deal::where('id',$request->dealid)->first();                    
                        $new  = new UserCoupon;
                        $new->deal_id = $request->dealid;
                        $new->user_id = $user_id;
                        $new->status = 0;
                        $new->phone = $request->phone;
                        $new->save();
                        // return $deal;
                        $nxt =  Carbon::createFromFormat('Y-m-d H:i:s', $new->created_at);
                        
                        //text ams starts here
                        $service_plan_id = env('SERVICE_PLAN_ID');
                        $bearer_token = env('BEARER_TOCKEN');

                        //Any phone number assigned to your API
                        $send_from = "+19512637122";
                        //May be several, separate with a comma ,
                        // +18135012075 
                        $recipient_phone_numbers = '+19'.str_replace('-','',$request->phone);
                        $route = route('deals.show',$deal->id);
                        // $message = "Click on the link bellow to Find You Coupon Details  {$recipient_phone_numbers} from {$send_from}";
                        $message = "Coupon Details \n".$deal->name."\n Click the link Bellow to find Dtials \n".$route. "\n Coupon will be Expired After 24 Hours at: ".$nxt;
                        
                        // Check recipient_phone_numbers for multiple numbers and make it an array.
                        if(stristr($recipient_phone_numbers, ',')){
                        $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
                        }else{
                        $recipient_phone_numbers = [$recipient_phone_numbers];
                        }

                        // Set necessary fields to be JSON encoded
                        $content = [
                        'to' => array_values($recipient_phone_numbers),
                        'from' => $send_from,
                        'body' => $message
                        ];

                        $data = json_encode($content);
                        $ch = curl_init("https://us.sms.api.sinch.com/xms/v1/{$service_plan_id}/batches");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
                        curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                    
                        $result = curl_exec($ch);
                        
                        // if(curl_errno($ch)) {
                        //     echo 'Curl error: ' . curl_error($ch);
                        // } else {
                        //     echo $result;
                        // }
                        curl_close($ch);

                        return response()->json([
                            'message' => 'phone is :'.$request->phone.$result,
                            // 'message' =>$request->email,
                        ]);
                    }
                // }
                }
            }
        }
        else
        {
            return response()->json([
                'message' =>'Kindly login first!',
            ]);
        }




        // return response()->json([
        //     'delete' =>$request->userid,
        // ]);
    }
}
