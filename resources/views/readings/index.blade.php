@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h3>Tento týden</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Datum</th>
                    <th>Název knihy</th>
                    <th>Počet přečtených stran</th>
                    <th>Stránka od - do</th>
                    <th>Doba čtení (min)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($readings as $reading)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($reading->date)->format('d.m.Y') }}</td>
                        <td>{{ $reading->book->title }}</td>
                        <td>{{ $reading->pages_read }}</td>
                        <td>{{ $reading->from_page }} - {{ $reading->to_page }}</td>
                        <td>{{ $reading->duration_minutes }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Zatím žádné záznamy na tento týden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <h3>Zadej záznam</h3>
        <form method="POST" action="{{ route('readings.store') }}">
            @csrf

            <div class="mb-2">
                <label>Datum</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Kniha</label>
                <select name="book_id" class="form-control" required>
                    <option value="">-- Vyber knihu --</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Od stránky</label>
                <input type="number" name="from_page" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Do stránky</label>
                <input type="number" name="to_page" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Délka čtení (v minutách)</label>
                <input type="number" name="duration_minutes" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Uložit záznam</button>
        </form>
    </div>
</div>
@endsection
