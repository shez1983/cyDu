@extends('adminlte::page')

@section('title', 'Update ' . $employee->name)

@section('content_header')
    <h1>Update {{ $employee->name }}</h1>
@stop

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Sorry, please fix these errors:<br/>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="post" action="{{ route('employees.update', ['employee' => $employee->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $employee->email) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="company_id" class="col-sm-2 col-form-label">Company</label>
            <div class="col-sm-10">
                <select name="company_id" required>
                    <option value="">-select-</option>
                    @foreach($companies as $company)
                        <option @if((int)$company->id === (int) old('company_id', $employee->company_id)) selected @endif
                                value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $employee->phone) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@stop