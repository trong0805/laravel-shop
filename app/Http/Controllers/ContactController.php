<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        // hiển thị ra ở trang admin
        $contacts = Contact::select('id', 'name', 'email', 'title', 'content')->Paginate(5);
        return view('admin.contacts.list', compact('contacts'));
    }
    public function delete($contact) {
        // xóa
        $contactDelete = Contact::find($contact);
        $contactDelete->delete();
        return redirect()->route('admin.contacts.list');
    }
    public function createContact() {
        //tạo phản hồi ở trang contact    
        return view('client.contact');
    }
    public function storeContact(ContactRequest $request) {
        //tạo phản hồi ở trang contact
        // dd($request->all());
        $contact = new Contact();
        
        $contact->fill($request->all());
        $contact->save();
        session()->flash('success', 'Gửi phản hồi thành công.');
        return redirect()->route('contacts.contact');
    }
}
