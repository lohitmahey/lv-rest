<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Manufacturer;

use Illuminate\Support\Facades\Session;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cars = Car::with( 'manufacturer' )->get();
        return view('car.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $manufacturers = Manufacturer::select('id','title')->get();
        $data = [
            'manufacturers' => $manufacturers,
            'manufacturers_id' => old('manufacturers_id'),
            'title' => old( 'title' ),
            'description' => old( 'description' )
        ];
        return view('car.form', $data);
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
            'manufacturers_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ],$messages = [
            'manufacturers_id.required' => 'Select a manufacturer!',
        ]);

        Car::create($validated);
        return redirect( 'car' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $car = Car::findOrFail($id);
        $manufacturer = Manufacturer::findOrFail($car->manufacturers_id);
        $data = [
            'manufacturer' => $manufacturer,
            'title' => $car->title,
            'description' => $car->description
        ];
        return view('car.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $car = Car::findOrFail($id);
        $manufacturers = Manufacturer::select('id', 'title')->get();
        $manufacturers_id = Session::has('errors') ? old('manufacturers_id') : $car->manufacturers_id;
        $title = Session::has('errors') ? old('title') : $car->title;
        $description = Session::has('errors') ? old('description') : $car->description;
        return view('car.form', ['manufacturers' => $manufacturers, 'manufacturers_id' => $manufacturers_id, 'title' => $title, 'description' => $description, 'edit' => true, 'edit_id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $car = Car::findOrFail($id);
        
        // check for validations
        $validated = $request->validate([
            'manufacturers_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $car->manufacturers_id = $request->get('manufacturers_id');
        $car->title = $request->get('title');
        $car->description = $request->get('description');
        $car->save();
        return redirect('car');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $car = Car::find($id);
        if( $car )
            $car->delete();
        
        return redirect( 'car' );
    }
}
