<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'email' => 'admin@email.net',
            'name'  => 'admin',
            'password' => Hash::make('password')
        ]);

        $questions = [
            'Выберите стиль кухни ↓ цвет не важен, выбирайте именно стиль' => [
                ['text' => 'Лофт', 'img' => config('app.url').'/1.jpg'],
                ['text' => 'Минимализм', 'img' => config('app.url').'/2.jpg'],
                ['text' => 'Хай тек', 'img' => config('app.url').'/3.jpeg'],
            ],
            'Выберите форму' => [
                ['text' => 'Прямая', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
                ['text' => 'Угловая', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
                ['text' => 'П-образная', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
                ['text' => 'Выберу позже', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
            ],
            'Выберите вид фасадов' => [
                ['text' => 'Глянцевые', 'img' => config('app.url').'/1.jpg'],
                ['text' => 'Матовые', 'img' => config('app.url').'/1.jpg'],
                ['text' => 'Выберу позже', 'img' => config('app.url').'/1.jpg'],
            ],
            'Укажите примерную длину кухонного гарнитура' => [
                ['text' => 'До 3 метров', 'type' => 'list'],
                ['text' => 'От 3 до 4 метров', 'type' => 'list'],
                ['text' => 'От 4 до 5 метров', 'type' => 'list'],
                ['text' => 'От 5 до 6 метров', 'type' => 'list'],
                ['text' => 'От 6 до 7 метров', 'type' => 'list'],
                ['text' => 'От 7 до 8 метров', 'type' => 'list'],
                ['text' => 'Укажу позже', 'type' => 'list']
            ],
            'Выберите высоту верхних модулей' => [
                ['text' => 'Стандартная 72 см', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
                ['text' => 'Высота 92 см', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
                ['text' => 'Под потолок', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
                ['text' => 'Выберу позже', 'img' => config('app.url').'/'.rand(1,2).'.jpg'],
            ],
            'Какую фурнитуру считать? (петли, ящики, ручки т.п.)' => [
                ['text' => 'Самую экономичную', 'type' => 'list'],
                ['text' => 'Средний сегмент', 'type' => 'list'],
                ['text' => 'Качественная фурнитура', 'type' => 'list'],
                ['text' => 'Самая лучшая', 'type' => 'list']
            ]
        ];

        foreach ($questions as $question => $answers){
            $quest = Question::create(['text' => $question]);
            foreach ($answers as $answer){
                $answer['question_id'] = $quest->id;
                Answer::create($answer);
            }
        }
    }
}
