<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactList extends Controller
{
    public function selectContact()
    {
        $contacts = DB::table('contacts')
            ->where('user_id', Auth::id())
            ->orderBy('name')
            ->get();

        return view('home', ['contacts' => $contacts]);
    }
    public function addContact(Request $req)
    {
        $req->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
        ],
        [
            'name.required' => 'To pole jest wymagane',
            'surname.required' => 'To pole jest wymagane',
            'address.required' => 'To pole jest wymagane',
            'phone.required' => 'To pole jest wymagane',
            'email.required' => 'To pole jest wymagane',
            'email.email' => 'Zły format adresu email. Np.: example@example.pl',
        ]);
        $auth = Auth::id();
        $name = $req->input('name');
        $surname = $req->input('surname');
        $address = $req->input('address');
        $phone = $req->input('phone');
        $email = $req->input('email');
        DB::table('contacts')->insert(['name' => $name, 'surname' => $surname, 'address' => $address, 'phone' => $phone, 'email' => $email, 'user_id' => $auth]);

        return redirect('home')->with('success', 'Pomyślnie dodałeś kontakt');
    }

    public function search(){
        $contacts = DB::table('contacts')
            ->where('user_id', Auth::id())
            ->where(function ($query) {
                $search_text = $_GET['search'];
                $query->orWhere('name', 'LIKE', '%' . $search_text . '%')
                      ->orWhere('surname', 'LIKE', '%' . $search_text . '%')
                      ->orWhere('address', 'LIKE', '%' . $search_text . '%')
                      ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                      ->orWhere('email', 'LIKE', '%' . $search_text . '%');
            })
            ->orderBy('name')
        ->get();

        return view('home', ['contacts' => $contacts]);
    }

    public function choice(Request $req){
        $checkedID = $req->input('choice');
        $contact = Contact::find($checkedID);
        if($checkedID != null){
            if (isset($_GET['edit'])){
                return view('edit', compact('contact'));
            } else if(isset($_GET['delete'])){
                $contact->delete();
                return redirect('home')->with('success', 'Pomyślnie usunąłeś kontakt');
            }
        } else {
            return redirect('home')->with('error', 'Wybierz który kontakt chcesz edytować/usunąć!');
        }
    }


    public function editContact(Request $req, Contact $contact){
        $checkedID = $req->input('id');
        $name = $req->input('name');
        $surname = $req->input('surname');
        $address = $req->input('address');
        $phone = $req->input('phone');
        $email = $req->input('email');
        DB::table('contacts')
            ->where('id', $checkedID)
            ->update(['name' => $name, 'surname' => $surname, 'address' => $address, 'phone' => $phone, 'email' => $email,]);
            
        return redirect('home')->with('success', 'Pomyślnie edytowałeś kontakt!');
    }
}
