<?php

namespace App\Services;

use GuzzleHttp\Client;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\View;

class MukeeyMailService
{

    public static function send($to, $title, $mailData, $view)
    {
        // \Log::info('Mukeey mail service called');
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $client = new Client([
            'headers' => $headers
        ]);

        $url = "https://my-email-server.onrender.com/send-email";

        $body = View::make($view, ['mailData' => $mailData])->render();
        $body = htmlspecialchars_decode($body);

        // dd($body);

        $query = json_encode([
            "smtp_host" =>  'smtp.gmail.com', //env('MAIL_HOST', 'smtp.gmail.com'),
            "smtp_port" =>  465, //env('MAIL_PORT', 465),
            "smtp_user" =>  'mualiyuoox@gmail.com', //env('MAIL_USERNAME', 'quick.clinic.app@gmail.com'),
            "smtp_pass" =>  'ujrn eziz ibft tokl', //env('MAIL_PASSWORD', 'wqft nyvp ouqk gkvn'),
            // data body
            "from_name" => 'Pmall Store',
            "from_email" => 'hello@pmall.com.ng',
            "to" => $to,
            "subject" => $title,
            "body" => $body,
        ], true);

        $data = null;
        try {
            $response = $client->post($url, [
                'body' => $query,
            ]);

            // Checking the network ststus of the response
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 300) {
                $data = json_decode($response->getBody(), true);
                return $data;
                // Successful response
                // \Log::info("Email sent successfully. Status code: $statusCode, Email: $to");
            } else {
                // Unsuccessful response
                // \Log::error("Failed to send email. Status code: $statusCode, Email: $to");
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $data; //Failed to send email
    }

}
