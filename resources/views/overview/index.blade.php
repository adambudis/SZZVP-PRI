@extends('layouts.app')

@section('content')
<div class="row g-4">
  {{-- Sekce: týdenní sourhn --}}
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Týdenní souhrn</h5>
        <div class="row text-center">
          <div class="col-md-4">
            <div class="h6 text-muted mb-1">Celkem stran</div>
            <div class="h3">{{ $totalPages }}</div>
          </div>
          <div class="col-md-4">
            <div class="h6 text-muted mb-1">Prům. doba čtení</div>
            <div class="h3">{{ $avgDurationMin }} min</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Sekce: uživatel --}}
  <div class="col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title mb-3">Uživatel</h5>

        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('overview.updateUser') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label">Jméno</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Oblíbený žánr</label>
            <input type="text" name="favorite_genre" class="form-control" value="{{ $user->favorite_genre }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Průměrná rychlost (z dat)</label>
            <input type="text" class="form-control" value="{{ $readingSpeed }} str./hod" disabled>
            <div class="form-text">Hodnota je vypočtena z týdenních záznamů.</div>
          </div>

          <button type="submit" class="btn btn-primary w-100">Uložit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
