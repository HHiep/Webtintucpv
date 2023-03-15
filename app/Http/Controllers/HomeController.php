<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth()->user();

        $listHome = Home::all()->where('status', 2);

        return view('home.list', compact('listHome', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data = Auth()->user();
        $name = $request->input('name', null);
        $post = $request->input('post', null);
        $picture = $request->file('image');
        $request->validate([
            'name' => 'required|min:3|max:255',
            'post' => 'required|min:1|max:1000',
            // 'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
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
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $data = Home::where('id', $id)->first();

        return view('home.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $name = $request->input('name', null);
        $post = $request->input('post', null);
        $picture = $request->file('image');
        $request->validate([
            'name' => 'required|min:1|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = Home::where('id', $id)->first();

        if (empty($picture) == true) {
            $urlPicture = $data->picture;
            return redirect()->route('home');
        } else {
            Storage::delete($data->image);

            $namePicture = $picture->hashName();

            $urlPicture = "/upload/home/" . $namePicture;

            $picture->store('upload/home');
            $home = Home::find($id);
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
        if (!Gate::allows('admin')) {
            abort(403);
        }
        $data = Home::find($id);
        $data->delete();
        return redirect()->back()->with('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
