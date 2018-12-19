@extends('layouts.app');

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            Update Tag: {{ $tag->tag }}
        </div>

        @include('admin.includes.errors');

        <div class="panel-body">
        <form action="{{ route('tag.update', [ 'id' => $tag->id ])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag">Name</label>
                <input type="text" name="tag" value="{{ $tag->tag }}" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <button type="submit" class="btn btn-info"> Update tag </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop