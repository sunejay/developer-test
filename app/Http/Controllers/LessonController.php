<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonUser;
use App\Events\LessonWatched;

class LessonController extends Controller
{
    public function list()
    {
        $lessons = Lesson::simplePaginate(1);

        return view('lessons.list', ['lessons' => $lessons]);
    }

    public function show(Request $request, Lesson $lesson)
    {
        $lesson = Lesson::where('id', $lesson->id)->first();
        return view('lessons.show', ['lesson' => $lesson]);
    }

    public function watch(Request $request, Lesson $lesson)
    {
        
        $lesson_user = new LessonUser();
        $lesson_user->user_id = $request->user()->id;
        $lesson_user->lesson_id = $lesson->id;
        $lesson_user->watched = 1;
        $lesson_user->save();

        event(new LessonWatched($lesson, $request->user()));
        
        return back();
    }
}
