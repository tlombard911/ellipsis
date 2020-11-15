@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="accordion" id="accordionExample">
            <div class="card">

                @foreach ($employees as $employee)
                <div class="card-header" id="heading-{{ $employee->id}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapse-{{ $employee->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$employee->name_last}}
                        </button>
                    </h2>
                </div>

                <div id="collapse-{{ $employee->id}}" class="collapse" aria-labelledby="heading-{{ $employee->id}}"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-fixed table-hover table-sm">
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td> <a class="btn btn-success" href="employee_requirements/create/{{ $employee->id }}">
                                        Add Additional Requirement Exlusion to: {{$employee->name_last}}</a>
                                </td>
                            </tr>
                            @foreach($employee->requirements->sortBy('name') as $row2)
                            <tr>
                                <td>{{$row2->name}}</td>
                                <td>{{$row2->pivot->exclusion}}</td>
                                <td>
                                    <form action="employee_requirements/delete/{{ $employee->id }}/{{ $row2->id }}"
                                        method="post">
                                        <a class="btn btn-info"
                                            href="{{ route('requirements.show',$employee->id) }}">Show</a>

                                        <a class="btn btn-primary"
                                            href="{{ route('requirements.edit',$employee->id) }}">Edit</a>
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
