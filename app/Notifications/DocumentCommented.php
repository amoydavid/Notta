<?php
/**
 * Wizard
 *
 * @link      https://aicode.cc/
 * @copyright 管宜尧 <mylxsw@aicode.cc>
 */

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Document;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DocumentCommented extends Notification
{
    use Queueable;

    private $document;
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @param Document $document
     * @param Comment  $comment
     */
    public function __construct(Document $document, Comment $comment)
    {
        $this->document = $document;
        $this->comment  = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'  => sprintf(
                '您创建的文档 <a href="%s#cm-%d">%s</a> 有新评论',
                wzRoute('project:home', [
                    'id' => $this->document->project_id,
                    'p'  => $this->document->id,
                    'cm' => $this->comment->id,
                ]),
                $this->comment->id,
                $this->document->title
            ),
            'document' => [
                'title' => $this->document->title,
                'id'    => $this->document->id,
            ],
            'comment'  => [
                'id'      => $this->comment->id,
                'user'    => $this->comment->user->name,
                'content' => $this->comment->content,
            ]
        ];
    }
}