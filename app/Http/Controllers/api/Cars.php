<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Car;
use App\Models\Manufacturer;
use App\Http\Resources\CarsResource;

class Cars extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $per_page = $request->has( 'per_page' ) ? $request->get( 'per_page' ) : 5;

        if( $request->has( 'with_manufacturer' ) )
            $cars = Car::with( 'manufacturer' )->paginate( $per_page );
        else
            $cars = Car::paginate( $per_page );

        return CarsResource::collection( $cars );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            // Validate the data
            $validate_data = [
                'title' => 'required',
                'description' => 'required',
                'manufacturers_id' => 'required'
            ];

            //Search for manufacturer
            $manufacturer = Manufacturer::find( $request->get('manufacturers_id') );
            if( !$manufacturer )
                return response()->json( 'Invalid Manufacturer ID', Response::HTTP_BAD_REQUEST );
            
            $car = new Car();
            $car->fill( $request->validate($validate_data) )->save();
            return new CarsResource($car);
        } catch( \Exception $exception ) {
            return response()->json( $exception->getMessage(), Response::HTTP_BAD_REQUEST );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        
        if( $request->has( 'with_manufacturer' ) ) {
            $car = Car::with( 'manufacturer' )->find($id);
        } else {
            $car = Car::find($id);
        }

        if( !$car ) {
            return response()->json( 'Invalid ID', Response::HTTP_BAD_REQUEST  );
        }

        return new CarsResource( $car );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $car = Car::find($id);
        $manufacturer = Manufacturer::find($request->get( 'manufacturers_id' ));

        if( !$car || !$manufacturer ) {
            return response()->json( 'Invalid ID', Response::HTTP_BAD_REQUEST  );
        }

        try {
            $car->title = $request->has('title') ? $request->get('title') : $car->title;
            $car->description = $request->has('description') ? $request->get('description') : $car->description;
            $car->manufacturers_id = $request->has('manufacturers_id') ? $request->get('manufacturers_id') : $car->manufacturers_id;
            $car->save();

            return new CarsResource( $car );
        } catch( \Exception $exception ) {
            return response()->json( $exception->getMessage(), Response::HTTP_BAD_REQUEST );
        }
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
        
        return response()->json( NULL, Response::HTTP_NO_CONTENT );
    }
}