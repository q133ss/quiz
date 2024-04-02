@extends('layouts.app')
@section('title', 'Заявка')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Заявка</div>
                    <div class="card-body">
                        <ul id="sortable">
                            <li style="display: flex; justify-content: space-between">
                                Телефон: {{ $item->phone }}
                            </li>

                            <li style="display: flex; justify-content: space-between">
                                Дата: {{ $item->created_at->format('d.m.Y H:i') }}
                            </li>
                        </ul>

                        <ul id="sortable">
                            <li><h4>Ответы</h4></li>
                            @foreach($item->getAnswers() as $answer)
                            <li style="display: flex; justify-content: space-between">
                                <span>{{$answer['question']}}</span>
                                <span>{{$answer['answer']}}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
