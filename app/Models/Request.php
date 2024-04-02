<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Request extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getAnswers()
    {
        $data = json_decode($this->answers);

        $items = [];

        foreach ($data as $quest => $answer){
            if(Answer::find($answer) instanceof Collection){
                $answers = [];
                foreach (Answer::whereIn('id',$answer)->get() as $answ){
                    $answers[] = $answ->text;
                }
                $items[] = [
                    'question' => Question::find($quest)->text,
                    'answer' => $answers,
                ];
            }else {
                $items[] = [
                    'question' => Question::find($quest)->text,
                    'answer' => Answer::find($answer)->text,
                ];
            }
        }

        return $items;
    }
}
