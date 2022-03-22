<?php

namespace App\Notifications;

use App\Models\article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArticleCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var User
     */
    private $user;
    /**
     * @var article
     */
    private $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Article $article)
    {

        $this->user = $user;
        $this->article = $article;
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
        $user = $this->user;
        $article = $this->article;
        return (new MailMessage)
                    ->subject('New Article Created')
                    ->line("Dear {$user->name}, you created a new article")
                    ->line("Article title: {$article->title}")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
