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
        if (auth()->user()) {
            $user_id = auth()->user()->id;

            if ($request->ajax()) {
                if (isset($request->email)) {
                    $check = UserCoupon::where('deal_id', $request->dealid)->where('user_id', $user_id)->where('email', $request->email)->first();
                    if ($check != null) {
                        return response()->json([
                            'emailed-already' => 'Coupon Already Emailed.',
                        ]);
                    } else {
                        $deal = Deal::where('id', $request->dealid)->first();
                        $new  = new UserCoupon;
                        $new->deal_id = $request->dealid;
                        $new->user_id = $user_id;
                        $new->status = 0;
                        $new->email = $request->email;
                        $new->save();

                        $nxt =  Carbon::createFromFormat('Y-m-d H:i:s', $new->created_at);
                        $data = array(
                            'subject' => 'Your Coupon Sent From YSO.',
                            'id' => $deal->id,
                            'location' => $deal->location,
                            'picture_url' => $deal->picture_url,
                            'name' => $deal->name,
                            'views' => $deal->views,
                            'expiry' => date_format($nxt->addDays(1), "Y-m-d H:i:s")
                        );
                        Mail::to($request->email)->send(new CouponMail($data));

                        return response()->json([
                            'emailed' => 'Email Sent Successfully!',
                        ]);
                    }
                }
                if (isset($request->phone)) {
                    $check = UserCoupon::where('deal_id', $request->dealid)->where('user_id', $user_id)->where('phone', $request->phone)->first();
                    if ($check != null) {
                        return response()->json([
                            'texted-already' => 'Coupon Already Texted.',
                        ]);
                    } else {
                        $deal = Deal::where('id', $request->dealid)->first();
                        $new  = new UserCoupon;
                        $new->deal_id = $request->dealid;
                        $new->user_id = $user_id;
                        $new->status = 0;
                        $new->phone = $request->phone;
                        $new->save();

                        $nxt =  Carbon::createFromFormat('Y-m-d H:i:s', $new->created_at);
                        $route = route('deals.show', $deal->id);
                        $recipient = '+1' . str_replace('-', '', $request->phone);
                        $message_to_send = "Coupon Details\n" . $deal->name . "\nClick the link below to find details\n" . $route . "\nCoupon will expire after 24 Hours at :\n" . $nxt;

                        $this->sendSms($recipient, $message_to_send);

                        return response()->json([
                            'texted' => 'Text Sent Successfully!',
                        ]);
                    }
                }
            }
        } else {
            return response()->json([
                'message' => 'Please login first!',
            ]);
        }
    }

    public function sendSms($recipient, $message_to_send)
    {
        //text sms starts here
        // Set necessary fields to be JSON encoded
        $content = [
            'from' => '19512637122',
            'to' => [$recipient],
            'body' => $message_to_send
        ];

        $data = json_encode($content);
        $ch = curl_init("https://sms.api.sinch.com/xms/v1/a6c7726640314b1eb8dcf92fed42ccd7/batches");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // Set HTTP Header for POST request 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer a13611040543430ca425709b7ed64048',
            'Content-Length: ' . strlen($data)
        ));

        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
        // curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        // $service_plan_id = env('SERVICE_PLAN_ID');
        // $bearer_token = env('BEARER_TOKEN');
        // $send_from = env('SEND_FROM');
        // $data = array(
        //     'from' => '19512637122',
        //     'to' => [$recipient],
        //     'body' => $message_to_send
        // );

        // $payload = json_encode($data);
        // // Prepare new cURL resource
        // $ch = curl_init('https://sms.api.sinch.com/xms/v1/a6c7726640314b1eb8dcf92fed42ccd7/batches');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // // Set HTTP Header for POST request 
        // curl_setopt(
        //     $ch,
        //     CURLOPT_HTTPHEADER,
        //     array(
        //         'Content-Type: application/json',
        //         'Authorization: Bearer a13611040543430ca425709b7ed64048',
        //         'Content-Length: ' . strlen($payload)
        //     )
        // );
        // // Submit the POST request
        // $result = curl_exec($ch);
        // print_r($result);
        // // Close cURL session handle
        // curl_close($ch);
    }
}
