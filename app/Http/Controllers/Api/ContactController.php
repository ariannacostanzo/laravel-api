<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function message() {

        $mail = new ContactMessageMail();
        Mail::to('test@ciao.it')->send($mail);
        return response(null, 204);
    }
}
