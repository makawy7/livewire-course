<?php

namespace App\Http\Livewire;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $successMessage;
    public function render()
    {
        return view('livewire.contact-form');
    }

    public function validateName()
    {
    }
    public function validateEmail()
    {
    }
    public function validatePhone()
    {
    }
    public function validatMessage()
    {
    }

    public function submitForm()
    {
        // request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'message' => 'required'
        // ]);
        $contact['name'] = $this->name;
        $contact['email'] = $this->email;
        $contact['phone'] = $this->phone;
        $contact['message'] = $this->message;

        Mail::to('ifilmtech@gmail.com')->send(new ContactFormMail($contact));
        
        $this->successMessage = 'We received your maessage successfully and will get back to you shortly!';
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
    }
}
