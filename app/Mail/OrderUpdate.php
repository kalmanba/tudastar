<?php


// app/Mail/OrderUpdate.php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $data;
    public $subjectLine; // Add this property

    public function __construct(Order $order, array $data)
    {
        $this->order = $order;
        $this->data = $data;
        
        // Set the subject in the constructor
        $this->subjectLine = match($data['type']) {
            'pickup' => 'Átvételi Időpont megerősítése',
            'tracking' => 'Csomagját postáztuk',
            default => 'Order Update'
        };
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                   ->view('emails.order-update');
    }
}