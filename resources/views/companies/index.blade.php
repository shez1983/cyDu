@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies
        <a class="btn btn-primary" href="{{ route('companies.create')}}">Create New</a>
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
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td><img src="{{ Storage::url($company->logo) }}" width="100" height="100" title="company logo"/></td>
                    <td><a href="{{ $company->website }}">{{ $company->website }}</a></td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('companies.edit', ['company' => $company->id]) }}">Edit</a> |

                        <form action="{{ route('companies.destroy', ['company' => $company->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No companies</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@stop