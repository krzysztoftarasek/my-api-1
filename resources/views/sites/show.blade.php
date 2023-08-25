@extends('sites.layout')
@section('content')

<div class="card">
  <div class="card-header">Site "{{ $site->domain }}" Page</div>
  <div class="card-body">
    <div class="card-body">
        <h5 class="card-title">Domain : {{ $site->domain }}</h5>
        <p class="card-text">Access : {{ $site->access }}</p>
    </div>
    </hr>
  </div>
</div>

@endsection