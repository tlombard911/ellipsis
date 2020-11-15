@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">GAP REPORT BUILDER</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('gap_report.store') }}" method="POST" target="_blank">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Organization') }}:
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="OrganizationOption"
                                        id="OrganizationOptio1" value="*" checked>
                                    <label class="form-check-label" for="inlineRadio1">Both</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="OrganizationOption"
                                        id="OrganizationOption2" value="Littleton Fire Rescue">
                                    <label class="form-check-label" for="inlineRadio1">Littleton Fire Rescue</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="OrganizationOption"
                                        id="OrganizationOption3" value="South Metro Fire Rescue">
                                    <label class="form-check-label" for="inlineRadio1">South Metro Fire
                                        Rescue</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="inlineRadio2">{{ __('Qualification') }}:
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="QualificationOption"
                                        id="QualificationOption1" value="requirementGapsAll" checked>
                                    <label class="form-check-label" for="inlineRadio2">Both</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="QualificationOption"
                                        id="QualificationOption2" value="requirementGapsActors">
                                    <label class="form-check-label" for="inlineRadio2">Can Act</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="QualificationOption"
                                        id="QualificationOption3" value="requirementGapsPromoted">
                                    <label class="form-check-label" for="inlineRadio2">Promoted</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <div class="form-check form-check-inline align-top">
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Shift') }}:
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <select multiple="multiple" size="8" class="form-control form-control-lg"
                                        name="shiftOptions[]" id="shiftOptions">
                                        @foreach ($shifts as $key => $value)
                                        <option value="{{ $value }}" selected="selected">
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10">
                                <div class="form-check form-check-inline">
                                    <span class="float-right"><a class="btn btn-primary"
                                            href="{{ route('requirements.index') }}"> Back</a></span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
