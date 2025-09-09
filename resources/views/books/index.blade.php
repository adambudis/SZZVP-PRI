@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h3>Moje knihovna</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Název</th>
                    <th>Autor</th>
                    <th>Rok vydání</th>
                    <th>Žánr</th>
                    <th>Počet stran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->genre }}</td>
                        <td>{{ $book->pages }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Žádné knihy nebyly nalezeny.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <h3>Přidej knihu</h3>
        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div class="mb-2">
                <label>Název knihy</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Autor</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Rok vydání</label>
                <input type="number" name="year" class="form-control" min="0" max="{{ date('Y') }}" required>
            </div>

            <div class="mb-2">
                <label>Žánr</label>
                <input type="text" name="genre" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Počet stran</label>
                <input type="number" name="pages" class="form-control" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Uložit knihu</button>
        </form>
    </div>
</div>
@endsection
