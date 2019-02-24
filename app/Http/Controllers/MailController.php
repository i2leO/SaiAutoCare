<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {


    	Mail::send(['text'=>'mail'],['name','Ashutosh'],function($message){
    		$message->to('ashutoshphoenixsoft@gmail.com','Ashutosh')->subject('Hello !!!');
    		$message->from('ashuashutoshchoubey@gmail.com','phoenix');
    	});exit;
    }
}
