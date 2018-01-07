<?php

namespace App\Notifications;

use App\Exam;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

//use Illuminate\Notifications\Messages\MailMessage;

class UploadExam extends Notification implements ShouldQueue
{
    use Queueable;
    protected $exam;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Exam $exam)
    {

        $this->exam = $exam;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'exam_id' => $this->exam->id,
        ];
    }
}
?>