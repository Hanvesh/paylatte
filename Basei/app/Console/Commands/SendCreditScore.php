<?php

namespace App\Console\Commands;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendCreditScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:creditScore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending credit Score to the respective user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $words = [
            'divya' => '600',
            'hanvesh' => '650',
            'nikhil' => '700',
            'bharat' => '750',
        ];

        // Finding a random word
        $key = Credit::all()->pluck('pancard')->random();
        $value = Credit::all()->where('pancard',$key)->pluck('credit_limit');
            Mail::raw("{$key} -> {$value}", function ($mail) {
                $mail->from('bummbleprimus18@gmail.com');
                $mail->to('divya.pitti@mpokket.com')
                    ->subject(' Credit_Score');
            });
        $this->info('Credit_Scores sent to All Users');
    }
}
