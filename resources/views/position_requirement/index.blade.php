@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="accordion" id="accordionExample">
            <div class="card">

                @foreach ($positions as $position)
                <div class="card-header" id="heading-{{ $position->id}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapse-{{ $position->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$position->name}}
                        </button>
                    </h2>
                </div>

                <div id="collapse-{{ $position->id}}" class="collapse" aria-labelledby="heading-{{ $position->id}}"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-fixed table-hover table-sm">
                            <tr>
                                <td>
                                </td>
                                <td> <a class="btn btn-success" href="position_requirements/create/{{ $position->id }}">
                                        Add Additional Requirement to: {{$position->name}}</a>
                                </td>
                            </tr>
                            @foreach($position->requirements->sortBy('name') as $row2)
                            <tr>
                                <td>{{$row2->name}}</td>
                                <td>
                                    <form action="position_requirements/delete/{{ $position->id }}/{{ $row2->id }}"
                                        method="post">
                                        <a class="btn btn-info"
                                            href="{{ route('requirements.show',$row2->id) }}">Show</a>

                                        <a class="btn btn-primary"
                                            href="{{ route('requirements.edit',$row2->id) }}">Edit</a>
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
