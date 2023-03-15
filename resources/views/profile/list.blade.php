@extends('layouts.index')
@section('main')
    <article class="post">

        <header>
            @foreach ($dataAll as $item)
                <div class="title">
                    <h2><a href="single.html">{{ $item->name }}</a></h2>
                    <p>Lorem ipsum dolor amet nullam consequat etiam feugiat</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">November 1, 2015</time>
                    <a href="{{ route('profile') }}" class="author"><span class="name">Jane Doe</span><img
                            src="{{ asset('assets/images/avatar.jpg') }}" alt="" /></a>
                </div>

        </header>
        <div><a href="single.html" class="image featured">
                <img src="{{ $item->image }}" alt="" /></a></div>
        <div>
            <p>{{ $item->post }}</p>
        </div>
        @if ($data->role == 0 && $item->status==0 ||$data->role == 0 && $item->status==1)
            <div> <a class="btn btn-info btn-rounded btn-fw "
                    href="{{ route('sendNotifications', [
                        'id' => $item->id,
                        'user_id' => $item->user_id,
                    ]) }}">Gui
                    yeu cau xet duyet</a></div>
        @endif
        <div> <a class="btn btn-info btn-rounded btn-fw " href="{{ route('profile.edit', $data->id) }}">Update</a></div>
        <form class="forms-sample"action=" {{ route('profile.destroy', $item->id) }}" method='POST'>

            @method('DELETE ')
            @csrf
            <button type="submit" class="btn btn-primary btn-rounded btn-fw">Delete</button>
        </form>
        @if ($data->role == 1)
            <div><a class="btn btn-info btn-rounded btn-fw "
                    href="{{ route('listNotification', [
                        'id' => $item->id,
                    ]) }}">list
                    Notification
                </a></div>
        @endif
        @endforeach
        <div><a class="btn btn-success btn-rounded btn-fw" href="{{ route('profile.create') }}">Add</a></div>

        <div> <a class="btn btn-success btn-rounded btn-fw" href="{{ route('home.logout') }}">Logout</a></div>

    </article>
@endsection
