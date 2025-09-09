@extends('layouts.app')

@section('content')
<div class="col-md-8 offset-md-2">
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h4 class="card-title mb-3">Můj profil</h4>

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="mb-2"><strong>Jméno:</strong> {{ $user->name }}</div>
      <div class="mb-2"><strong>Email:</strong> {{ $user->email }}</div>
      <div class="mb-2"><strong>Oblíbený žánr:</strong> {{ $user->favorite_genre ?? '—' }}</div>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Smazat data / účet</h5>
      <p class="text-muted">Zde můžete smazat pouze svá data (knihy a čtenářské záznamy), nebo účet včetně všech dat.</p>

      <div class="row g-3">
        <div class="col-md-6">
          <div class="border rounded p-3 h-100">
            <h6>Pouze smazat data</h6>
            <p class="small text-muted mb-3">Knihy a čtenářské záznamy budou odstraněny. Účet zůstane aktivní.</p>
            <form method="POST" action="{{ route('profile.deleteData') }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-warning w-100">Smazat pouze data</button>
            </form>
          </div>
        </div>

        <div class="col-md-6">
          <div class="border rounded p-3 h-100">
            <h6>Smazat účet i data</h6>
            <p class="small text-muted mb-3">Účet bude zrušen a všechna data nevratně smazána. Budete odhlášeni.</p>
            <form method="POST" action="{{ route('profile.deleteAccount') }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger w-100">Smazat účet a data</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
