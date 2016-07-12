<?php

namespace App\Listeners;

use App\Events\ArticleCreateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Utilities\Mails\MailTemplates;
use App\Utilities\Mails\MailSubjects;
use App\Utilities\Settings;

class ArticleCreateEventListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  ArticleCreateEvent  $event
     * @return void
     */
    public function handle(ArticleCreateEvent $event)
    {
        $article = $event->article;
        $author = $article->author;
        Mail::send(MailTemplates::ARTICLE_CREATION, ['user' => $author], function ($m) use ($author) {
            $m->from(Settings::SYSTEM_EMAIL, 'Blog-Notification');
            $m->to($author->email, $author->name)->subject(MailSubjects::ARTICLE_CREATION);
        });
    }

}
