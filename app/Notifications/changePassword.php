<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class changePassword extends Notification
{
    use Queueable;

    public $receptor;
    public $password; 
    public $email;
    public function __construct($receptor, $password, $email)
    {

        $this->receptor = $receptor;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('mail.passwords.newpassword',[
                        'receptor'=>$this->receptor,
                        'password'=>$this->password,
                        'email'=>$this->email,

        ])
        ->subject('Información de usuario')
        ->from('adminportales@bhtrademarket.com.mx', 'HHGLOBAL');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
