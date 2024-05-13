<?php

namespace App\Notifications;

use App\Models\Borrow;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApproveBorrowRequestPdfBookMessage extends Notification
{
    use Queueable;

    protected Product $product;
    protected Borrow $borrow;
    /**
     * Create a new notification instance.
     */
    public function __construct($product, $borrow)
    {
        $this->product = $product;
        $this->borrow = $borrow;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Congratulation Your Borrow Request Has Been Approved.')
                    ->action('Show PDf' ,route('view-pdf',['product' => $this->product->id, 'borrow' => $this->borrow->id]))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
