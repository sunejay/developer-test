<?php

namespace App\Providers;

use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listeners\LessonWatchedListener;
use App\Listeners\CommentWrittenListener;
use App\Events\AchievementUnblocked;
use App\Events\BadgeUnblocked;
use App\Listeners\AchievementListener;
use App\Listeners\BadgeListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            CommentWrittenListener::class
        ],
        LessonWatched::class => [
            LessonWatchedListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
