<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class MailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $strs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($strs)
    {
         $this->strs = $strs;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      Mail::send(['text' => 'mail'], ['name' => 'Kazuya-C'], function($message) {
        $message->to('kazuya.takahashi.631130@gmail.com', 'To Riku')->subject('test email');
        $message->from('kazuya.takahashi.631130@gmail.com', $this->strs);
      });

      // php arisan make:provider MailProvider
      // php artisan make:job MailJob
      // .envファイルでメールサーバの設定
      // php artisan queue:table
      // php artisan queue:failed-table
      // php artisan migrate
      
    }
}
