{{-- подключение шаблона --}}
@extends('layout')
@section('content')
    <h1 class="text-center">Редактировать заявку</h1>
    <form action="{{ route('applications.update', $application) }}" method="post">
        @method('PUT')
        <div class="mb-3">
            <label for="room" class="form-label">Помещение</label>
            <input type="text" class="form-control" id="room" name="room" value="{{$application->room}}">
        </div>
        {{-- вывод ошибки валидации для поля помещение --}}
        @error('room')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="starts_at" class="form-label">Дата начала</label>
            <input type="text" class="form-control" id="starts_at" name="starts_at" value="{{$application->starts_at}}" >
        </div>
        {{-- вывод ошибки валидации для поля дата начала --}}
        @error('starts_at')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="payment" class="form-label">Способ оплаты</label>
            <select class="form-select" aria-label="Default select example" name="payment">
                <option value="При очном посещении">При очном посещении</option>
                <option value="Переводом по системе СБП">Переводом по системе СБП</option>
            </select>
        </div>
        {{-- вывод ошибки валидации для поля способ оплаты --}}
        @error('payment')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-primary" >Редактировать заявку</button>
    </form>
@endsection
