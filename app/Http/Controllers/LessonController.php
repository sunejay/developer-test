<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonUser;
use App\Events\LessonWatched;

class LessonController extends Controller
{
    public function watch(Request $request, Lesson $lesson)
    {
        $lesson_user = new LessonUser();
        $lesson_user->user_id = $request->user()->id;
        $lesson_user->lesson_id = $id;
        $lesson_user->watched = 1

        event(new LessonWatched($lesson, $request->user()));
        
        return back();

    }
}
