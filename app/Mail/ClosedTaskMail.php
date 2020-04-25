<?php

namespace App\Mail;

use App\Task;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClosedTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver;
    public $task;

    /**
     * Create a new message instance.
     *
     * @param User $receiver
     * @param Task $task
     */
    public function __construct(User $receiver, Task $task)
    {
        $this->receiver = $receiver;
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.closedTask');
    }
}
