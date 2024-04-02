<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionController\StoreRequest;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::orderBy('order', 'ASC')->get();
        return view('question.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::transaction(function() use ($request) {
            $questionData = [
                'text' => $request->text,
                'order' => Question::orderBy('order','DESC')->pluck('order')->first() + 1
            ];

            $question = Question::create($questionData);

            if($request->answ_text) {
                foreach ($request->answ_text as $k => $text) {
                    if ($text != null) {
                        $data = [
                            'text' => $text,
                            'next_question_id' => $request->next_question_id[$k],
                            'question_id' => $question->id,
                            'type' => $request->type,
                        ];

                        if (isset($request->file('img')[$k])) {
                            $data['img'] = config('app.url') . '/storage/' . $request->file('img')[$k]->store('img', 'public');
                        }

                        Answer::create($data);
                    }
                }
            }
        });

        return to_route('home')->withSuccess('Вопрос успешно добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        $questions = Question::orderBy('order', 'ASC')->get();
        return view('question.edit', compact('question', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        DB::transaction(function() use ($request, $id) {
            $questionData = [
                'text' => $request->text,
                'order' => Question::orderBy('order','DESC')->pluck('order')->first() + 1
            ];

            $question = Question::findOrFail($id)->update($questionData);

            if($request->answ_text) {
                foreach (Answer::where('question_id', $id)->get() as $answ){
                    Storage::disk('public')->delete(str_replace(config('app.url').'/storage/', '', $answ->img));
                    $answ->delete();
                }

                foreach ($request->answ_text as $k => $text) {
                    if ($text != null) {
                        $data = [
                            'text' => $text,
                            'next_question_id' => $request->next_question_id[$k],
                            'question_id' => $id,
                            'type' => $request->type,
                        ];

                        if (isset($request->file('img')[$k])) {
                            $data['img'] = config('app.url') . '/storage/' . $request->file('img')[$k]->store('img', 'public');
                        }

                        Answer::create($data);
                    }
                }
            }
        });

        return to_route('home')->withSuccess('Вопрос успешно изменен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Answer::where('question_id', $id)->delete();
        Question::findOrFail($id)->delete();
        return back()->withSuccess('Вопрос успешно удален');
    }
}
