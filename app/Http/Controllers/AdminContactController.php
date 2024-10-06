<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminContactController extends Controller
{
    // contact info page
    public function index(){
        $contacts = Contact::orderBy("created_at","desc")->paginate(3);
        return view("admin.contact.index",compact("contacts"));
    }

    // delete conatct
    public function delete(Request $request, Contact $contact){
        $contact->delete();
        Alert::alert('Contact delete', 'Delete Successful!!!' );
        return back();
    }
}
