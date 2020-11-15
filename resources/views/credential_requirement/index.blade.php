@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="accordion" id="accordionExample">
            <div class="card">

                @foreach ($requirements as $requirement)
                <div class="card-header" id="heading-{{ $requirement->id}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapse-{{ $requirement->id}}" aria-expanded="true"
                            aria-controls="collapseOne">
                            {{$requirement->name}}
                        </button>
                    </h2>
                </div>

                <div id="collapse-{{ $requirement->id}}" class="collapse"
                    aria-labelledby="heading-{{ $requirement->id}}" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-fixed table-hover table-sm">
                            <tr>
                                <td>
                                </td>
                                <td> <a class="btn btn-success"
                                        href="credential_requirements/create/{{ $requirement->id }}">
                                        Add Additional Requirement to: {{$requirement->name}}</a>
                                </td>
                            </tr>
                            @foreach($requirement->credentials->sortBy('name') as $row2)
                            <tr>
                                <td>{{$row2->name}}</td>
                                <td>
                                    <form action="credential_requirements/delete/{{ $requirement->id }}/{{ $row2->id }}"
                                        method="post">
                                        <a class="btn btn-info"
                                            href="{{ route('requirements.show',$requirement->id) }}">Show</a>

                                        <a class="btn btn-primary"
                                            href="{{ route('requirements.edit',$requirement->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Sure Want Delete?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div> @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
