@extends('layouts.index')
@section('main')
    <h4 class="panel-heading">Add Category</h4>
    <div class="table-responsive">

        <table class="table">
            <tbody>
                <form role="form" method="POST" enctype="multipart/form-data" action="{{route('profile.store')}}">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name">
                        @error('name')
                            <div style="color: red"></div>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label>Post</label>
                        <input class="form-control" name="post">
                        @error('post')
                            <div style="color: red"></div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-12">
                        <label>File input</label>
                        <input type="file" name="image">
                        @error('image')
                            <div style="color: red"></div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Hoàn thành</button>

                </form>
            </tbody>
        </table>
    @endsection
