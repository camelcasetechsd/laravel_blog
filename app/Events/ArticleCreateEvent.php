<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Post;
use App\Models\User;

class ArticleCreateEvent extends Event
{

    use SerializesModels;

    /**
     * Trticle title instance
     * @var Post 
     */
    public $article;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

}
