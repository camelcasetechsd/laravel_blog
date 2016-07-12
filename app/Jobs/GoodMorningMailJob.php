<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Utilities\Mails\MailTemplates;
use App\Utilities\Mails\MailSubjects;
use App\Utilities\Settings;
use App\Models\User;

class GoodMorningMailJob extends Job implements ShouldQueue
{

    use InteractsWithQueue,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $users = User::all();
        foreach ($users as $user) {
            Mail::send(MailTemplates::GOOD_MORNIING, ['user' => $user], function ($m) use ($user) {
                $m->from(Settings::SYSTEM_EMAIL, 'Blog-Notification');
                $m->to($user->email, $user->name)->subject(MailSubjects::GOOD_MORNING);
            });
            // after first user
            break;
        }
    }

}
