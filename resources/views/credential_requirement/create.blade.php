@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Add a Credential to the {{ $requirement->name }} Requirement </div>
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
                    <form action="{{ route('credential_requirements.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <!--<label for="requirement"
                                class="col-md-4 col-form-label text-md-right">{{ __('Requirement') }}:
                                {{ $requirement->name }}</label> -->
                            <div class="col-md-6">
                                <input id="requirement_id" type="hidden" name="requirement_id"
                                    value="{{ $requirement->id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="credential"
                                class="col-md-4 col-form-label text-md-right">{{ __('Credential') }}:
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" id="credential_id" name="credential_id">
                                    <option value="0">Select Credential</option>
                                    @foreach ($credentials as $key => $value)
                                    <option value="{{ $key }}" }}>
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col ">
                                <span class="float-right"><a class="btn btn-primary"
                                        href="{{ route('credential_requirements.index') }}"> Back</a></span>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
