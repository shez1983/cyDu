@extends('adminlte::page')

@section('title', 'Create a company')

@section('content_header')
    <h1>Create a company</h1>
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

    <form method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="website" class="col-sm-2 col-form-label">Website</label>
            <div class="col-sm-10">
                <input type="url" name="website" class="form-control" id="website" value="{{ old('website') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="logo" class="col-sm-2 col-form-label">Logo</label>

            <div class="col-sm-10 custom-file">
                <input type="file" name="logo" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file (< 1 MB)</label>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@stop