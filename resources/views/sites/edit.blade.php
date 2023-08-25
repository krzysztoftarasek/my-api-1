@extends('sites.layout')
@section('content')

<div class="card">
  <div class="card-header">Edit "{{ $site->domain }}" site Page</div>
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

    <form action="{{ route('sites.update', $site->id) }}" method="post">
      @csrf
      @method('PUT')
      <label>Domain</label></br>
      <input type="text" name="domain" id="domain" class="form-control" value="{{ $site->domain }}" ></br>
      <label>Access</label></br>
      <input type="text" name="access" id="access" class="form-control" value="{{ $site->access }}" ></br>
      <input type="submit" value="Save" class="btn btn-success"></br>
    </form>

  </div>
</div>

@endsection