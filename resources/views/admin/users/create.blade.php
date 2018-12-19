@extends('layouts.app');

@section('content')



    <div class="panel panel-default">

        <div class="panel-heading">
            Create a new User
        </div>

        @include('admin.includes.errors');

        <div class="panel-body">
        <form action="{{ route('user.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <button class="btn btn-info" type="submit">Add user</button>
                </div>
            </form>
        </div>
    </div>

@stop