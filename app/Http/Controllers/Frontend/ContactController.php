<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\Response;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $id = $request->header('id');
        $user = User::find($id);
        return view('pages.contact.contact', compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|integer',
            'subject' => 'nullable',
            'des' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone_num = $request->phone_num;
        $contact->subject = $request->subject;
        $contact->des = $request->des;
        $contact->save();

        return Response::Out("success", "Send Your Message!", "", 200);
    }
}
