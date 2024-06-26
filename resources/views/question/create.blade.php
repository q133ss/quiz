@extends('layouts.app')
@section('title', 'Добавить вопрос')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Добавить вопрос</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{route('question.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Текст вопроса</label>
                                <input type="text" class="form-control" name="text" value="{{old('text')}}">
                            </div>

                            <div class="form-group">
                                <label for="">Тип ответов</label>
                                <select name="type" id="" class="form-control">
                                    <option @if(old('type') == 'default') selected @endif value="default">Текст + картинка</option>
                                    <option @if(old('type') == 'list') selected @endif value="list">Список без картинок</option>
                                    <option @if(old('type') == 'checkbox') selected @endif value="checkbox">Множественный выбор</option>
                                </select>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" name="required" type="checkbox" value="on" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Обязательный вопрос
                                </label>
                            </div>

                            <div class="d-flex justify-content-between mt-2 mb-2">
                                <h4>Ответы</h4>
                                <button class="btn btn-primary" type="button" onclick="addAnswer()">Добавить ответ</button>
                            </div>

                            <div id="answers">
                                @if(old('answ_text'))
                                    @php $count = 99999; @endphp
                                    @foreach(old('answ_text') as $k => $value)
                                        @php $count++; @endphp
                                        <div class="border mt-2 p-2" id="answ_{{$count}}">
                                            <div class="form-group">
                                                <label for="img">Картинка</label>
                                                <input type="file" id="img" name="img[]" value="{{old('img')[$k]}}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="txt">Текст*</label>
                                                <input type="text" id="txt" name="answ_text[]" value="{{$value}}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="next_question_id">Следющий вопрос</label>
                                                <select name="next_question_id[]" id="next_question_id" class="form-control">
                                                    <option value="0">По порядку</option>
                                                    @foreach($questions as $question)
                                                        <option @if(old('next_question_id')[$k] ?? 0 == $question->id) selected @endif value="{{$question->id}}">{{$question->text}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="button" onclick="deleteQuestion({{$count}})" class="btn btn-link text-danger">Удалить ответ</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Добавить вопрос</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let count = 0;
        function addAnswer(){
            count++;
            $('#answers').append(
                '<div class="border mt-2 p-2" id="answ_'+count+'">'+
                '    <div class="form-group">'+
                '        <label for="img">Картинка</label>'+
                '        <input type="file" id="img" name="img[]" class="form-control">'+
                '    </div>'+
                '    <div class="form-group">'+
                '        <label for="txt">Текст*</label>'+
                '        <input type="text" id="txt" name="answ_text[]" class="form-control">'+
                '    </div>'+
                '    <div class="form-group">'+
                '        <label for="next_question_id">Следющий вопрос</label>'+
                '        <select name="next_question_id[]" id="next_question_id" class="form-control">'+
                '            <option value="0">По порядку</option>'+
                '           @foreach($questions as $question)'+
                '           <option value="{{$question->id}}">{{$question->text}}</option>'+
                '           @endforeach'+
                '        </select>'+
                '    </div>'+
                '    <button type="button" onclick="deleteQuestion('+count+')" class="btn btn-link text-danger">Удалить ответ</button>'+
                '</div>'
            );
        }

        function deleteQuestion(id){
            $('#answ_'+id).remove();
        }
    </script>
@endsection
