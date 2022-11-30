<?php

namespace DissanayakeG\SimpleFormSubmission\Http\Controllers;

use App\Http\Controllers\Controller;
use DissanayakeG\SimpleFormSubmission\Mail\ContactMailable;
use DissanayakeG\SimpleFormSubmission\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function index()
    {
        return view('formsubmission::form');
    }

    public function send(Request $request)
    {
        Contact::create($request->all());
        Mail::to(config('formsubmission.send_email_to'))->send(new ContactMailable($request->message));
        return redirect(route('contact-form'));
    }
}
