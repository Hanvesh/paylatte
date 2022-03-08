<?php

namespace App\Http\Controllers;

use App\Jobs\TestSendEmail;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;

class TestQueueEmails extends Controller
{
    public function sendTestEmails()
    {
        $emailJobs = new TestSendEmail();
        $this->dispatch($emailJobs);
    }
}
