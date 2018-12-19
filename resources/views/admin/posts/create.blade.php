@extends('layouts.app');

@section('content')



    <div class="panel panel-default">

        <div class="panel-heading">
            Create a new post
        </div>

        @include('admin.includes.errors');

        <div class="panel-body">
        <form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="file">Featured Image</label>
                    <input type="file" name="file" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a category</label>
                    <select name="category_id" id="category" class="form-control">

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea type="content" id="summernote" cols="5" rows="5" name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <input type="submit" value="Submit" class="btn btn-info">
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@stop