<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\QuestionController\StoreRequestRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::orderBy('order', 'ASC')->with('answers')->get();
    }

    public function next(string $id)
    {
        $answer = Answer::findOrFail($id);
        if($answer->next_question_id == null) {
            return Question::where('order', '>', $answer->question->order)->with('answers')->first();
        }else{
            return Question::findOrFail($answer->next_question_id)->load('answers');
        }
    }

    public function request(StoreRequestRequest $request)
    {
        $answers = [];

        foreach ($request->questions as $k => $question){
            $answers[$question] = $request->answers[$k];
        }

        \App\Models\Request::create([
            'phone' => $request->phone,
            'answers' => json_encode($answers),
            'region' => $request->region,
            'date' => $request->date,
            'additional' => $request->additional,
            'network_type' => $request->network_type
        ]);

        return Response()->json(['message' => true], 201);
    }
}
