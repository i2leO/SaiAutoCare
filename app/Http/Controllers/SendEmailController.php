<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
use Mail;
// use App\Mail\SendMail;
class SendEmailController extends Controller
{
    function send(Request  $requet)
    {
    	Mail::send(['text'=>'mail'],['name','Ashutosh'],function($message){
    		$message->to('ashutoshphoenixsoft@gmail.com','Ashutosh')->subject('Test Email');
    		$message->from('ashuashutoshchoubey@gmail.com','phoenix');
    	})

    	// Mail::to('ashutoshphoenixsofts@gmail.com')->send(new SendMail($data));
    	// return view('emails.exception');
    }
}
