@extends('layouts.app');

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            Edit blog settings
        </div>

        @include('admin.includes.errors');

        <div class="panel-body">
        <form action="{{ route('settings.update')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="site_name">Site name</label>
                    <input type="text" name="site_name" value="{{ $settings->site_name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                <input type="text" name="address" value="{{ $settings->address }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="street">Street</label>
                    <input type="text" name="street" value="{{ $settings->street }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact email</label>
                    <input type="email" name="contact_email" value="{{ $settings->contact_email }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact phone</label>
                    <input type="text" name="contact_number" value="{{ $settings->contact_number }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hours">Working hours</label>
                    <input type="text" name="hours" value="{{ $settings->hours }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" cols="5" rows="5" name="description" value="{{ $settings->description }}" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-info" type="submit" style="float:right;">Update site settings</button>
                </div>
            </form>
        </div>
    </div>

@stop