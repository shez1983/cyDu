@extends('adminlte::page')

@section('title', $company->name)

@section('content_header')
    <h1>{{ $company->name }}</h1>
@stop

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td><img src="{{ Storage::url($company->logo) }}" width="100" height="100" title="company logo"/></td>
                <td><a href="{{ $company->website }}">{{ $company->website }}</a></td>
            </tr>
        </tbody>
    </table>
@stop