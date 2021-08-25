<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentWritten;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Models\User;
use App\Helpers\Comments;
use App\Helpers\Badges;

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
        
        $user = User::where('id', $event->comment->user_id)->first();
        $comments_written = $user->comments()->count();
        $lessons_watched = $user->watched()->count();
        $total_achievements = $lessons_watched + $comments_written;
        // dd();

        if ($comments_written == 1) {
            event(new AchievementUnlocked(Comments::FIRST, $user));
        } elseif ($comments_written == 3) {
            event(new AchievementUnlocked(Comments::THIRD, $user));
        } elseif ($comments_written == 5) {
            event(new AchievementUnlocked(Comments::FIFTH, $user));
        } elseif ($comments_written == 10) {
            event(new AchievementUnlocked(Comments::TENTH, $user));
        } elseif ($comments_written == 20) {
            event(new AchievementUnlocked(Comments::TWENTIETH, $user));
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
