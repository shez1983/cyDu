@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h1>Employees
        <a class="btn btn-primary" href="{{ route('employees.create')}}">Create New</a>
    </h1>
@stop

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('employees.edit', ['employee' => $employee->id]) }}">Edit</a>

                        <form action="{{ route('employees.destroy', ['employee' => $employee->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No employees</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop