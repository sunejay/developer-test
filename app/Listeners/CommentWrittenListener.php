<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentWritten;

class CommentWrittenListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        $comments_achievements = [
            "first" => "First Comment Written",
            "third" => "3 Comments Written",
            "fifth" => "5 Comments Written",
            "tenth" => "10 Comment Written",
            "twentieth" => "20 Comment Written"
        ];

        $lessons_achievements = [
            "beginner" => "Beginner: 0 Achievements",
            "intermediate" => "Intermediate: 4 Achievements",
            "advanced" => "Advance: 8 Achievements",
            "master" => "Master: 10 Achievements"
        ];
        
        if ($comments_written > 0 && $comments_written == 1) {
            event(new AchievementUnblockedEvent($comments_written["first"], $event->comment->user()));
        } elseif ($comments_written > 0 && $comments_written == 3) {
            event(new AchievementUnblockedEvent($comments_written["third"], $event->comment->user()));
        } elseif ($comments_written > 0 && $comments_written == 5) {
            event(new AchievementUnblockedEvent($comments_written["fifth"], $event->comment->user()));
        } elseif ($comments_written > 0 && $comments_written == 10) {
            event(new AchievementUnblockedEvent($comments_written["tenth"], $event->comment->user()));
        } elseif ($comments_written > 0 && $comments_written == 20) {
            event(new AchievementUnblockedEvent($comments_written["twentieth"], $event->comment->user()));
        }
        
    }
}
