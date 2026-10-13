{{-- подключение шаблона --}}
@extends('layout')
@section('content')
    <h1 class="text-center">Админ панель</h1>
    <h2>Заявки:</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Идентификатор</th>
                <th scope="col">ФИО пользователя</th>
                <th scope="col">Помешение</th>
                <th scope="col">Желаемая дата начала</th>
                <th scope="col">Способ оплаты</th>
                <th scope="col">Статус</th>
                <th scope="col">Отзыв</th>
                <th scope="col">Сменить статус</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr data-testid="admin-row">
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->user->full_name }}</td>
                    <td>{{ $application->room }}</td>
                    <td>{{ $application->starts_at }}</td>
                    <td>{{ $application->payment }}</td>
                    <td>{{ $application->status }}</td>
                    @if ($application->review)
                        <td>Отзыв: {{ $application->review->content }}</td>
                    @else
                        <td> </td>
                    @endif
                    <td data-testid="admin-row">
                        <form action="{{ route('admin.status', $application) }}" method="POST">
                            @method('PUT')
                            <select class="form-select" aria-label="Default select example" datatestid="admin-status" name="status">
                                <option value="Мероприятие назначено">Мероприятие назначено</option>
                                <option value="Завершено">Завершено</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Сменить статус</button>
                        </form>

                    </td>
            @endforeach
        </tbody>
    </table>
@endsection
