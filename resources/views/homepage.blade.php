@extends('layouts.app')

@section('content')
<div class="row g-4">
  <div class="col-12">
    <h3>Domovská stránka - týdenní a měsíční čtenářská aktivita</h3>
  </div>

  {{-- MĚSÍČNÍ REPORT (VLEVO) --}}
  <div class="col-lg-6">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <h5 class="card-title mb-3">Tento měsíc</h5>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between">
            <span>Přečtené stránky</span><strong>{{ $monthlyPages }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Průměrná rychlost</span><strong>{{ $monthlySpeed }} str./hod</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Počet čtených knih</span><strong>{{ $monthlyBooksCount }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Počet čtení (záznamů)</span><strong>{{ $monthlyReadingsCount }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Nejrychlejší rychlost</span><strong>{{ $fastestMonthlySpeed }} str./hod</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Nejpomalejší rychlost</span><strong>{{ $slowestMonthlySpeed }} str./hod</strong>
          </li>
        </ul>
      </div>
    </div>
  </div>

  {{-- TÝDENNÍ REPORT (VPRAVO) --}}
  <div class="col-lg-6">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <h5 class="card-title mb-3">Tento týden</h5>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between">
            <span>Přečtené stránky</span><strong>{{ $weeklyPages }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Průměrná rychlost</span><strong>{{ $weeklySpeed }} str./hod</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Počet čtených knih</span><strong>{{ $weeklyBooksCount }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Počet čtení (záznamů)</span><strong>{{ $weeklyReadingsCount }}</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Nejrychlejší rychlost</span><strong>{{ $fastestWeeklySpeed }} str./hod</strong>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Nejpomalejší rychlost</span><strong>{{ $slowestWeeklySpeed }} str./hod</strong>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
