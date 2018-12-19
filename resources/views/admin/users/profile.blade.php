@extends('layouts.app');

@section('content')



    <div class="panel panel-default">

        <div class="panel-heading">
            Edit your profile
        </div>

        @include('admin.includes.errors');

        <div class="panel-body">
        <form action="{{ route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="name" value="{{ $user->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="avatar">Upload new Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                </div>

                <div class="form-group">
                    <label for="facebook">Facebook profile</label>
                    <input type="text" name="facebook" value="{{ $user->profile->facebook }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="youtube">Youtube profile</label>
                    {{-- {{ profile-> oznacava da je u profile tabeli }} --}}
                    <input type="text" name="youtube" value="{{ $user->profile->youtube }}" class="form-control">
                </div>

                <div class="form-group">
                    <textarea name="about" id="about" value="{{ $user->profile->about }}" cols="6" rows="6" class="form-control">{{ $user->profile->about }}</textarea>
                </div>

                <div class="form-group">
                  <button class="btn btn-info" type="submit">Update user</button>
                </div>
            </form>
        </div>
    </div>

@stop