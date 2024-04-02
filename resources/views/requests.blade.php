@extends('layouts.app')
@section('title', 'Заявки')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Заявки</div>
                <div class="card-body">
                    <ul id="sortable">
                        @foreach($requests as $item)
                            <li id="item_{{ $item->id }}" style="display: flex; justify-content: space-between">
                                {{ $item->phone }}
                                <div class="ctrl d-flex align-items-center gap-2">
                                    {{$item->created_at->format('d.m.Y H:i')}}
                                    <a href="{{route('requests.show', $item->id)}}">Подробнее</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
