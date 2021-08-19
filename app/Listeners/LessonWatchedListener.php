<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LessonWatched;
use App\Events\AchievementUnblockedEvent;
use App\Events\BadgeUnblockedEvent;

class LessonWatchedListener
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
    public function handle(LessonWatched $event)
    {
        $lessons_achievements = [
            "first" => "First Comment Written",
            "fifth" => "5 Comments Written",
            "tenth" => "10 Comment Written",
            "twenty_fifth" => "25 Comments Written",
            "fiftieth" => "50 Comment Written"
        ];

        $lessons_achievements = [
            "beginner" => "Beginner: 0 Achievements",
            "intermediate" => "Intermediate: 4 Achievements",
            "advanced" => "Advance: 8 Achievements",
            "master" => "Master: 10 Achievements"
        ];

        $lessons_watched = $event->user->watched();

        if ($lessons_watched > 0 && $lessons_watched == 1) {
            event(new AchievementUnblockedEvent($lessons_watched["first"], $event->user));
        } elseif ($lessons_watched > 0 && $lessons_watched == 5) {
            event(new AchievementUnblockedEvent($lessons_watched["fifth"], $event->user));
        } elseif ($lessons_watched > 0 && $lessons_watched == 10) {
            event(new AchievementUnblockedEvent($lessons_watched["tenth"], $event->user));
        } elseif ($lessons_watched > 0 && $lessons_watched == 25) {
            event(new AchievementUnblockedEvent($lessons_watched["twenty_fifth"], $event->user));
        } elseif ($lessons_watched > 0 && $lessons_watched == 50) {
            event(new AchievementUnblockedEvent($lessons_watched["fiftieth"], $event->user));
        }
        
    }
}
