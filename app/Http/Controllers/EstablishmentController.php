<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('establishments.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'required|image',
            'direction' => 'required',
            'suburb' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'phone' => 'required|numeric',
            'description' => 'required',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
            'uuid' => 'required',
        ]);
        $path_image = $request['image']->store('mainImages', 'public');
        $image = Image::make(public_path("storage/{$path_image}"))->fit(800, 450);
        $image->save();
        $establishment = new Establishment($data);
        $establishment->image = $path_image;
        $establishment->user_id = auth()->user()->id;
        $establishment->save();
        return back()->with('status', 'Establishment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $establishment)
    {
        return 'desde edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Establishment $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishment $establishment)
    {
        //
    }
}
