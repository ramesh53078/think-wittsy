<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Admin\Feedback;
class SendFeedbackEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $feedback;
    protected $userEmail;
    public function __construct(Feedback $feedback, $userEmail)
    {
        $this->feedback = $feedback;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subject = 'Thank You for Your Feedback';
        $view = 'emails.thank-you';

        Mail::to($this->userEmail)
            ->send(new FeedbackMail($this->feedback, $subject));
    }
}
