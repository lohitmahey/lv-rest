<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

use Illuminate\Support\Facades\Session;

class ManufacturersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $manufacturers = Manufacturer::all();
        return view('manufacturer.index', ['manufacturers' => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $data = [
            'title' => old( 'title' ),
            'description' => old( 'description' )
        ];
        return view('manufacturer.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // check for validations
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Manufacturer::create($validated);
        return redirect( 'manufacturer' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $manufacturer = Manufacturer::findOrFail($id);
        $data = [
            'title' => $manufacturer->title,
            'description' => $manufacturer->description
        ];
        return view('manufacturer.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $manufacturer = Manufacturer::findOrFail($id);
        $title = Session::has('errors') ? old('title') : $manufacturer->title;
        $description = Session::has('errors') ? old('description') : $manufacturer->description;
        return view('manufacturer.form', ['title' => $title, 'description' => $description, 'edit' => true, 'edit_id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $manufacturer = Manufacturer::findOrFail($id);
        
        // check for validations
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $manufacturer->title = $request->get('title');
        $manufacturer->description = $request->get('description');
        $manufacturer->save();
        return redirect('manufacturer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $manufacturer = Manufacturer::find($id);
        if( $manufacturer )
            $manufacturer->delete();
        
        return redirect( 'manufacturer' );
    }

    /**
     * Get list of all the cars by a manufacturer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCarsByManufacturer($id) {

        $manufacturer = Manufacturer::findOrFail($id);
        $cars = $manufacturer->cars;

        $data = [
            'title' => $manufacturer->title,
            'description' => $manufacturer->description,
            'cars' => $cars,
        ];
        return view('manufacturer.view-with-cars', $data);
    }
}
