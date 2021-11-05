@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Registerd Users</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name.' '. $user->lname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>
                                <a
                                    class="btn btn-outline-primary btn-sm"
                                    href="{{ url('view-users/'.$user->id) }}">
                                    View User
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection