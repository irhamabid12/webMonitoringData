@extends('layout.app')

@section('title', 'Dashboard')
@section('content')
<div class="card text-center" style="position: fixed; height: 100%; width: 100%;">
  <div class="card-body overflow-auto">
      <div class="tab-content" id="tabContent-dashboard" style="overflow-y: hidden">
          <div class="tab-pane fade show active h-100" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
              @include('dashboard')
          </div>
          <div class="tab-pane fade" id="pills-chart" role="tabpanel" aria-labelledby="pills-chart-tab" tabindex="0">
              @include('riwayat')
          </div>
          <div class="tab-pane fade" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab" tabindex="0">
              @include('setting')
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
              @include('profile')
          </div>
      </div>
  </div>
  <div class="card-footer text-center">
      <ul class="nav nav-pills mb-3 justify-content-center" id="tab-dasboard" role="tablist">
          <li class="nav-item col text-center" role="presentation">
            <button class="nav-link col-12 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
              <i class="bi bi-house-fill"></i>
            </button>
          </li>
          <li class="nav-item col" role="presentation">
            <button class="nav-link col-12" id="pills-chart-tab" data-bs-toggle="pill" data-bs-target="#pills-chart" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
              <i class="bi bi-pie-chart-fill"></i>
            </button>
          </li>
          <li class="nav-item col" role="presentation">
            <button class="nav-link col-12" id="pills-setting-tab" data-bs-toggle="pill" data-bs-target="#pills-setting" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
              <i class="bi bi-gear-fill"></i>
            </button>
          </li>
          <li class="nav-item col" role="presentation">
            <button class="nav-link col-12" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" onclick="getAkun({{ Auth::user()->id }})">
              <i class="bi bi-person-fill"></i>
            </button>
          </li>
        </ul>
  </div>
</div>
@endsection
@include('jsFunction')