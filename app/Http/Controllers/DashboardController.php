<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Phone;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function redirect()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        if (!Auth::check()) {
            return redirect('/register');
        }
    }

    public function index()
    {
        $contacts = Contact::with('user')
                            ->orderBy('id', 'desc')
                            ->paginate(5);             
        return view('dashboard', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $fields = $request->validate([
            'contact' => 'required|string|unique:contacts',
            'email' => 'required|string|email|unique:emails',
            'phone' => 'required|string|digits:9|unique:phones'
            ]);
        
        $contacts = Contact::create([
            'contact' => $fields['contact'],
            'user_id' => Auth::id()
        ]);

        $contact_id = Contact::select()->where('contact', 'LIKE', "{$fields['contact']}")->get();
        $id = $contact_id[0]->id;
        
        $email = Email::create([
            'email' => $fields['email'],
            'contact_id' => $id
        ]);
        $phone = Phone::create([
            'phone' => $fields['phone'],
            'contact_id' => $id
        ]);

        return redirect()->back()->with('message', 'Успешно добавлено');
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
        Contact::find($id)->update($request->all());
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
        Contact::destroy($id);
        return redirect('dashboard')->with('deleteMsg', 'Contact deleted successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = Contact::select()
                            ->where('id', 'LIKE', "%{$search}%")
                            ->orWhere('contact', 'LIKE', "%{$search}%")
                            ->orderBy('id', 'desc')
                            ->paginate(5);
        return view('search', compact('results'));
    }
}
