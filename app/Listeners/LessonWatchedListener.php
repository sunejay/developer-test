<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LessonWatched;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Helpers\Lesson;
use App\Helpers\Badges;
use App\Models\User;

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
        $user = User::where('id', $event->user->id)->first();
        // dd();
        $lessons_watched = $event->user->watched()->count();
        $comments_written = $event->user->comments()->count();
        $total_achievements = $lessons_watched + $comments_written;

        if ($lessons_watched == 1) {
            event(new AchievementUnlocked(Lesson::FIRST, $user));
        } elseif ($lessons_watched == 5) {
            event(new AchievementUnlocked(Lesson::FIFTH, $user));
        } elseif ($lessons_watched == 10) {
            event(new AchievementUnlocked(Lesson::TENTH, $user));
        } elseif ($lessons_watched == 25) {
            event(new AchievementUnlocked(Lesson::TWENTYFIFTH, $user));
        } elseif ($lessons_watched == 50) {
            event(new AchievementUnlocked(Lesson::FIFTIETH, $user));
        }

        if ($total_achievements == 0 || $total_achievements == 1) {
            event(new BadgeUnlocked(Badges::BEGINNER, $user));
        } elseif ($total_achievements == 4) {
            event(new BadgeUnlocked(Badges::INTERMEDIATE, $user));
        } elseif ($total_achievements == 8) {
            event(new BadgeUnlocked(Badges::ADVANCE, $user));
        } elseif ($total_achievements == 10) {
            event(new BadgeUnlocked(Badges::MASTER, $user));
        } 
        
    }
}
