<?php

namespace App\Mail;

use App\Model\Conference;
use App\Model\Paper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaperNotify extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $conf;
    public $paper;

    /**
     * Create a new message instance.
     *
     * @param Conference $conf
     * @param Paper $paper
     */
    public function __construct(Conference $conf, Paper $paper)
    {
        $this->conf = $conf;
        $this->paper = $paper;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notify');
    }
}
