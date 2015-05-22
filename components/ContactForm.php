<?php namespace Archybold\ContactForm\Components;

use Lang;
use Cms\Classes\ComponentBase;

class ContactForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'archybold.contactform::lang.component.name',
            'description' => 'archybold.contactform::lang.component.description',
        ];
    }

    public function defineProperties(){
        return [
            'email' => [
                'title'             => 'archybold.contactform::lang.prop_email.title',
                'description'       => 'archybold.contactform::lang.prop_email.description',
                'default'           => '',
                'type'              => 'string',
                'placeholder'       => 'you@yourdomain.com'
            ],
            'from' => [
                'title'             => 'archybold.contactform::lang.prop_from.title',
                'description'       => 'archybold.contactform::lang.prop_from.description',
                'default'           => '',
                'type'              => 'string',
                'placeholder'       => 'noreply@yourdomain.com'
            ],
        ];
    }

    public function onRun()
    {
        $this->addJs('/plugins/archybold/contactform/assets/js/contactform.js');
    }

    public function onSend(){
        $name = post('name');
        $email_address = post('email');
        $phone = post('phone');
        $message = post('message');

        // Check for empty fields
        if (empty($name)          ||
            empty($email_address) ||
            empty($message)       ||
            !filter_var($email_address, FILTER_VALIDATE_EMAIL)){
            return "error";
        }
            
        // Create the email and send the message
        $to = $this->property('email');
        $email_subject = "Website Contact Form:  $name";
        $email_body = "You have received a new message from your website contact form."
            ."\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: ".$this->property('from')."\n";
        $headers .= "Reply-To: $email_address";
        mail($to, $email_subject, $email_body, $headers);

        return "success";
    }

}
