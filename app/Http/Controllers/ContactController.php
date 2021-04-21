<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Phone;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('name', $id)->first();             
        return view('contact', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = url()->previous();
        $urlPath = parse_url($url, PHP_URL_PATH);
        $urlId = explode("/", $urlPath);       
        
        if (empty($request->input('email')) && empty($request->input('phone'))) {
            $fields = $request->validate([
                'email' => 'required',
                'phone' => 'required',
            ]);
        }
        if (!empty($request->input('email'))) {
            $fields = $request->validate([
                'email' => 'string|email|unique:emails'
            ]);    
            $email = Email::create([
                'email' => $fields['email'],
                'contact_id' => $urlId[2]
            ]);
        }

        if (!empty($request->input('phone'))) {
            $fields = $request->validate([
                'phone' => 'string|digits:9|unique:phones'
            ]);    
            $phone = Phone::create([
                'phone' => $fields['phone'],
                'contact_id' => $urlId[2]
            ]);
        }
        
        return redirect()->back()->with('message', 'Успешно добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacts = Contact::find($id);
        $emails = Email::where('contact_id', $id)->get(); 
        $phones = Phone::where('contact_id', $id)->get(); 
        return view('contact', compact('contacts', 'emails', 'phones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('email')) {
            $request->validate([
                'email' => 'required|string|email|unique:emails'
            ]);
            $update = Email::find($id);
            $update->update($request->all());
        }
        if ($request->input('phone')) {
            $request->validate([
                'phone' => 'required|string|digits:9|unique:phones'
            ]);
            $update = Phone::find($id);
            $update->update($request->all());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Email::destroy($id);
        Phone::destroy($id);
        return redirect()->back();
    }
}
