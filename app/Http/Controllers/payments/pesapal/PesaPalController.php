<?php

namespace App\Http\Controllers\payments\pesapal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PesaPalController extends Controller
{
    public function getAccessToken()
    {
        $url = env('PESAPAL_ENV') == 0
        ? 'https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken'
        : 'https://pay.pesapal.com/v3/api/Auth/RequestToken';

       
        $response = Http::post($url, [
            'consumer_key' => 'qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW',
            'consumer_secret' => 'osGQ364R49cXKeOYSpaOnT++rHs=',
        ]);
        $data = json_decode($response, true);
        return $data->data->token;
        
    }

    public function makeHttp($url, $body)
    {
        $url = env('PESAPAL_ENV') == 0
        ? ' https://cybqa.pesapal.com/pesapalv3/api/'.$url
        : 'https://pay.pesapal.com/v3/api/'.$url;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => array('Content-Type:application/json','Authorization:Bearer '. $this->getAccessToken()),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($body)
                )
        );
        $curl_response = curl_exec($curl);
        // $curl_response = Http::withHeaders([
        //     'Content-Type:application/json',
        //     'Authorization:Bearer '. $this->getAccessToken()
        // ])->post($url, [
        //     'consumer_key' => 'qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW',
        //     'consumer_secret' => 'osGQ364R49cXKeOYSpaOnT++rHs=',
        // ]);

        curl_close($curl);
        return $curl_response;
    }

    public function requestLipaNaPesaPal(Request $request)
    {
        $curl_post_data = array(
            
            "id"=> "TEST1515111110",
            "currency"=> "KES",
            "amount"=> 100.00,
            "description"=> "Payment description goes here",
            "callback_url"=> "https://www.myapplication.com/response-page",
            "notification_id"=> "fe078e53-78da-4a83-aa89-e7ded5c456e6",
            "billing_address"=> [
                "email_address"=> "john.doe@example.com",
                "phone_number"=> null,
                "country_code"=> "",
                "first_name"=> "John",
                "middle_name"=> "",
                "last_name"=> "Doe",
                "line_1"=> "",
                "line_2"=> "",
                "city"=> "",
                "state"=> "",
                "postal_code"=> null,
                "zip_code"=> null]

          );

        $res = $this->makeHttp('/Transactions/SubmitOrderRequest', $curl_post_data);

        return $res;
    }
}
