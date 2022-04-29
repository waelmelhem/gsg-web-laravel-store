<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class orderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $order;
     protected $meesage;
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast',"mail"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order=$this->order;
        $billing =$order->addresses()->where("type",'billing')->first();
        // dd($billing->first_name);
        $this->meesage="$billing->first_name  $billing->last_name has new order (#$order->number)";
        return (new MailMessage)
                    ->from("wael@gmail.com","store Admin")
                    ->subject("New Order #".$this->order->name)
                    ->line($this->meesage)
                    ->greeting("Hello $notifiable->name")
                    ->action('Order', url('/dashboard/orders/'.$order->id))
                    ->line('Thank you for using our application!');
    }
    public function toDatabase($notifiable){
        return [        
            'title'=>"New Order #".$this->order->number,
            "body"=> $this->meesage,
            "image"=>'',
            "url"=>'/dashboard/orders/'.$this->order->id,
            "order"=>$this->order,
        ];
    }

    public function toBroadcast($notifiable)
    {
        $order=$this->order;
        $billing =$order->addresses()->where("type",'billing')->first();
        // dd($billing->first_name);
        $this->meesage="$billing->first_name  $billing->last_name has new order (#$order->number)";
        return (new BroadcastMessage([
            'title'=>"New Order #".$this->order->number,
            "body"=> $this->meesage,
            "image"=>'',
            "url"=>'/dashboard/orders/'.$this->order->id,
            "order"=>$this->order,
        ]));  
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
