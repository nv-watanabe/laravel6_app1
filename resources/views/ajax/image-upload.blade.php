@extends('ajax.layout')


@section('content')
    <div class="container">

        <h1>Laravel 5 - Ajax Image Uploading Tutorial</h1>


        <form action="{{ route('ajax.image.upload') }}" enctype="multipart/form-data" method="POST">


            <div class="alert alert-danger print-error-msg" style="display:none">

                <ul></ul>

            </div>


            <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="form-group">

                <label>Alt Title:</label>

                <input type="text" name="title" class="form-control" placeholder="Add Title">

            </div>


            <div class="form-group">

                <label>Image:</label>

                <input type="file" name="image" class="form-control">

            </div>


            <div class="form-group">

                <button class="btn btn-success upload-image" type="submit">Upload Image</button>

            </div>


        </form>


    </div>

@endsection
