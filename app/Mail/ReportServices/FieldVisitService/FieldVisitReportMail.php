<?php

namespace App\Mail\ReportServices\FieldVisitService;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FieldVisitReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data, $pdf_file;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $pdf_file)
    {
        $this->data = $data;
        $this->pdf_file = $pdf_file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reportservices.fieldvisitservice.fieldVisitReport')
            ->attachData($this->pdf_file, $this->data['report_id'].'.pdf', [
                   'mime' => 'application/pdf',
               ]);
    }
}
