<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
class ContactsControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        return view("contacts.index",compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("contacts.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'number' => ['required','integer'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imagePath = request('image')->store('uploads', 'public');
        // $image = Image::make("/storage/{$imagePath}")->fit(1200, 1200);
        // $image->save();
        auth()->user()->contacts()->create([
            'name' => $data['name'],
            'number' => $data['number'],
            'image' => "/storage/{$imagePath}"
        ]);
        // \App\Models\Contacts::create($data);
        return redirect("/contacts");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Contacts $contact)
    {
        $data = request()->validate([
            'name' => 'required',
            'number' => ['required','integer'],
            'image' => ''
        ]);
        if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');

            $imageArray = ['image' => "/storage/{$imagePath}"];
        }

        $contact->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contacts $contact)
    {
        $contact->delete();
        return redirect('/contacts');
    }
}
