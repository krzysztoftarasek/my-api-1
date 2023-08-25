@extends('sites.layout')
@section('content')

<div class="card">
  <div class="card-header">Site Page</div>
  <div class="card-body">

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('sites.store') }}" method="post">
      @csrf
      <label>Domain</label></br>
      <input type="text" name="domain" id="domain" class="form-control"></br>
      <label>Access</label></br>
      <input type="text" name="access" id="access" class="form-control"></br>
      <input type="submit" value="Save" class="btn btn-success"></br>
    </form>

  </div>
</div>

@endsection