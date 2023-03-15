@extends('layouts.index')
@section('main')
    <article class="post">
       
        <header>
            @foreach ($listHome as $item => $list)
       
                @php
                    $param = [
                        'id' => $list->id,
                    ];
                @endphp
                <div class="title">
                    <h2><a href="single.html">{{ $list->name }}</a></h2>
                    <p>Lorem ipsum dolor amet nullam consequat etiam feugiat</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">November 1, 2015</time>
                    <a href="{{ route('profile') }}" class="author"><span class="name">Jane Doe</span><img
                            src="{{ asset('assets/images/avatar.jpg') }}" alt="" /></a>
                </div>
        </header>

        <a href="single.html" class="image featured">
            <img src="{{ $list->image }}" alt="" /></a>
        <p>{{ $list->post }}</p>

   
        @if ($data->role != 0)
      
        
            <a class="btn btn-info btn-rounded btn-fw " href="{{ route('home.edit', $list->id) }}">Update</a>
            <form class="forms-sample"action="{{ route('home.destroy', $list->id) }} " method='POST'>
                @method('DELETE ')
                @csrf
                <button type="submit" class="btn btn-primary btn-rounded btn-fw">Delete</button>
            </form>

           


    </article>
    @endif
    @endforeach
    <a class="btn btn-success btn-rounded btn-fw" href="{{ route('home.create') }}">Add</a>
    <a class="btn btn-success btn-rounded btn-fw" href="{{ route('home.logout') }}">Logout</a>
@endsection
