@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Вопросы <a href="{{route('question.create')}}" class="btn btn-link p-0">Добавить вопрос</a></div>
                <div class="card-body">
                    <ul id="sortable">
                        @foreach($questions as $item)
                            <li id="item_{{ $item->id }}" style="display: flex; justify-content: space-between">
                                {{ $item->text }}
                                <div class="ctrl d-flex align-items-center gap-2">
                                    <a href="{{route('question.edit', $item->id)}}">Изменить</a>
                                    <form action="{{route('question.destroy', $item->id)}}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0">Удалить</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $("#sortable").sortable({
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                // Отправка данных на сервер
                $.ajax({
                    url: "{{ route('updateOrder') }}",
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        });
        $("#sortable").disableSelection();
    });
</script>
@endsection
