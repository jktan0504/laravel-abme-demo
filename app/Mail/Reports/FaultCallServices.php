<?php

namespace App\Mail\Reports;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FaultCallServices extends Mailable
{
    use Queueable, SerializesModels;
    public $reportID, $messageContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reportID, $messageContent)
    {
        $this->reportID = $reportID;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reports.faultCallReport');
    }
}
