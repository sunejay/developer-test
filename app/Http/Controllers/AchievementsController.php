<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Lesson;
use App\Helpers\Comments;
use App\Helpers\Badges;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    protected $unlocked_achievements = [];
    protected $next_available_achievements = [];
    protected $current_badge  = "";
    protected $next_badge = "";
    protected $remaining_to_unlock_next_badge = 0;

    public function index(User $user)
    {
        $watched = $user->watched()->count();
        $written = $user->comments()->count();
        $batch = $watched + $written;

        if ($watched >= 1 && $watched < 5) {
            $this->unlocked_achievements[] = Lesson::FIRST;
            $this->next_available_achievements[] = Lesson::FIFTH;
        } elseif ($watched >= 5 && $watched < 10) {
            $this->unlocked_achievements = [Lesson::FIRST, Lesson::FIFTH];
            $this->next_available_achievements[0] = Lesson::TENTH;
        } elseif ($watched >= 10 && $watched < 25) {
            $this->unlocked_achievements = [Lesson::FIRST, Lesson::FIFTH, Lesson::TENTH];
            $this->next_available_achievements[0] = Lesson::TWENTYFIFTH;
        } elseif ($watched >= 25 && $watched < 50) {
            $this->unlocked_achievements = [Lesson::FIRST, Lesson::FIFTH, Lesson::TENTH, Lesson::TWENTYFIFTH];
            $this->next_available_achievements[0] = Lesson::FIFTIETH;
        } elseif ($watched >= 50) {
            $this->unlocked_achievements = [Lesson::FIRST, Lesson::FIFTH, Lesson::TENTH, Lesson::TWENTYFIFTH, Lesson::FIFTIETH];
        }

        if ($written >= 1 && $written < 3) {
            array_push($this->unlocked_achievements, Comments::FIRST);
            $this->next_available_achievements[1] = Comments::THIRD;
        } elseif ($written >= 3 && $written < 5) {
            array_push($this->unlocked_achievements, Comments::FIRST, Comments::THIRD);
            $this->next_available_achievements[1] = Comments::FIFTH;
        } elseif ($written >= 5 && $written < 10) {
            array_push($this->unlocked_achievements, Comments::FIRST, Comments::THIRD, Comments::FIFTH);
            $this->next_available_achievements[1] = Comments::TENTH;
        } elseif ($written >= 10 && $written < 20) {
            array_push($this->unlocked_achievements, Comments::FIRST, Comments::THIRD, Comments::FIFTH, Comments::TENTH);
            $this->next_available_achievements[1] = Comments::TWENTIETH;
        } elseif ($written >= 20) {
            array_push($this->unlocked_achievements, Comments::FIRST, Comments::THIRD, Comments::FIFTH, Comments::TENTH, Comments::TWENTIETH);
        }

        if ($batch >= 0 && $batch < 4) {
            $this->current_badge = Badges::BEGINNER;
            $this->next_badge = Badges::INTERMEDIATE;
            $this->remaining_to_unlock_next_badge = 4 - $batch;
        } elseif ($batch >= 4 && $batch < 8) {
            $this->current_badge = Badges::INTERMEDIATE;
            $this->next_badge = Badges::ADVANCE;
            $this->remaining_to_unlock_next_badge = 8 - $batch;
        } elseif ($batch >= 8 && $batch < 10) {
            $this->current_badge = Badges::ADVANCE;
            $this->next_badge = Badges::MASTER;
            $this->remaining_to_unlock_next_badge = 10 - $batch;
        } elseif ($batch >= 10) {
            $this->current_badge = Badges::MASTER;
            // $this->next_badge = Badges::MASTER;
        }

        return response()->json([
            'unlocked_achievements' => $this->unlocked_achievements,
            'next_available_achievements' => $this->next_available_achievements,
            'current_badge' => $this->current_badge,
            'next_badge' => $this->next_badge,
            'remaining_to_unlock_next_badge' => $this->remaining_to_unlock_next_badge
        ]);
    }
}
