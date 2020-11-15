@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">Requirements</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <table class="table table-bordered table-fixed table-hover table-sm">
                    <tr>
                        <th style="width: 80%">Name</th>
                        <th style="width: 20%"><a class="btn btn-success" href="{{ route('requirements.create') }}">
                                Create New
                                Requirement</a>
            </div>
            </th>
            </tr>
            @foreach ($requirements as $requirement)
            <tr>
                <td>{{ $requirement->name }}</td>
                <td>
                    <form action="{{ route('requirements.destroy',$requirement->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('requirements.show',$requirement->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('requirements.edit',$requirement->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Sure Want Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </table>
            {!! $requirements->links() !!}
        </div>
    </div>
</div>
</div>
@endsection
