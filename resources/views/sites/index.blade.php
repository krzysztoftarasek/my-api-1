@extends('sites.layout')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-9">
      @if ($message = Session::get('success'))
        <div class="mt-3 alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h2>All sites</h2>
        </div>
        <div class="card-body">
          <a href="{{ route('sites.create') }}" class="btn btn-success btn-sm" title="Add New Site">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
          </a>
          <div class="table-responsive mt-5">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Domain</th>
                  <th>Access</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($sites as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td><a href="{{ route('sites.show', $item->id) }}" title="View Site">{{ $item->domain }}</a></td>
                  <td>{{ $item->access }}</td>

                  <td>
                    <a href="{{ route('sites.edit', $item->id) }}" title="Edit Site" class="btn btn-primary btn-sm">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                    </a>

                    <form method="POST" action="{{ route('sites.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" title="Delete Site" onclick="return confirm(&quot;Confirm delete?&quot;)">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>

            {!! $sites->links() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection