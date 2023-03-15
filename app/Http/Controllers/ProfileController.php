<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth()->user();
        $dataAll = Home::select('homes.id', 'homes.user_id', 'homes.name', 'homes.image', 'homes.post', 'homes.status')
            ->join('users', 'homes.user_id', '=', 'users.id')
            ->where('homes.user_id', $data->id)
          
            ->get();


        return view('profile.list', compact('dataAll', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('name', null);
        $post = $request->input('post', null);
        $picture = $request->file('image');
        $request->validate([
            'name' => 'required|min:3|max:255',
            'post' => 'required|min:1|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data = Auth()->user();
        $namePicture = $picture->hashName();
        $urlPicture = "/upload/home/" . $namePicture;
        $picture->store('upload/home');
        $home = new Home;
        $home->name = $name;
        $home->post = $post;
        $home->user_id = $data->id;
        $home->image = $urlPicture;
        if ($data->role == 1) {
            $home->status = 2;
        }
        $home->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = Home::where('user_id', $id)->first();

        return view('profile.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $name = $request->input('name', null);
        $post = $request->input('post', null);
        $picture = $request->file('image');
        $request->validate([
            'name' => 'required|min:1|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Home::where('user_id', $id)->first();

        if (empty($picture) == true) {
            $urlPicture = $data->picture;
            return redirect()->route('home');
        } else {

            Storage::delete($data->image);

            $namePicture = $picture->hashName();

            $urlPicture = "/upload/home/" . $namePicture;

            $picture->store('upload/home');
            $home = Home::find($data->id);
            $home->name = $name;
            $home->post = $post;
            $home->image = $urlPicture;
            $home->save();
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = Home::find($id);

        $data->delete();


        return redirect()->back()->with('home');
    }

    public function sendNotifications(Request $request)
    {
        $id = $request->input('id', '');
        $data = Home::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->route('profile');
    }

    public function listNotification()
    {
        $data = Auth()->user();
        $dataAll = Home::select('homes.id', 'homes.user_id', 'homes.name', 'homes.image', 'homes.post', 'homes.status')
            ->join('users', 'homes.user_id', '=', 'users.id')
            ->where('homes.status', 1)
            ->get();


        return view('profile.listnotification', compact('dataAll', 'data'));
    }


    public function confirmAdmin(Request $request)
    {
        $id = $request->input('id', '');
        $data = Home::find($id);
        $data->status = 2;
        $data->save();
        return redirect()->route('home');
    }
}
