{{-- подключение шаблона --}}
@extends('layout')
@section('content')
    <h1 class="text-center">Мои заявки</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Идентификатор</th>
                <th scope="col">Помешение</th>
                <th scope="col">Желаемая дата начала</th>
                <th scope="col">Способ оплаты</th>
                <th scope="col">Статус</th>
                <th scope="col">Отзыв</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr data-testid="reqlist">
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->room }}</td>
                    <td>{{ $application->starts_at }}</td>
                    <td>{{ $application->payment }}</td>
                    <td>{{ $application->status }}</td>
                    @if ($application->status == 'Завершено' && !$application->review)
                        <td data-testid="reqlist">
                            <form action="{{ route('reviews.store', $application) }}" method="POST">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Отзыв:</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" data-testid="req-review"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Оставить отзыв</button>
                            </form>

                        </td>
                    @elseif ($application->review)
                        <td>Отзыв: {{ $application->review->content }}</td>
                    @else
                        <td>Дождитесь завершения мероприятия</td>
                    @endif

                    <td>
                        <a href="{{ route('applications.edit', $application) }}">Редактировать</a>
                        <form action="{{ route('applications.destroy', $application) }}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
            @endforeach
        </tbody>
    </table>
@endsection
