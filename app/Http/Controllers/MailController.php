<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminder;
use Illuminate\Support\Facades\Auth;
use Carbon;
class MailController extends Controller
{

    public function mail()
    {
        //$mail='aa92212tw@gmail.com';
//        Auth::user()->Member_name;
//        $mail = '0f65677f8c-3cea69@inbox.mailtrap.io';
//        $mail=Auth::user()->E_mail;
//        $user =Member::find(1)->toArray();

      //  Mail::to($mail)->send(new Reminder);
//        Mail::send('emails.mailExample', $user, function($message) use ($user) {
//            $message->to($user->email);
//            $message->subject('E-Mail Example');
//        });

        dd('Mail Send Successfully');
    }
}
