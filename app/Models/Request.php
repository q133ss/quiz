<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getAnswers()
    {
        $data = json_decode($this->answers);

        $items = [];

        foreach ($data as $quest => $answer){
            $items[] = [
                'question' => Question::find($quest)->text,
                'answer' => Answer::find($answer)->text,
            ];
        }

        return $items;
    }
}
