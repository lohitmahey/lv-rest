<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Manufacturer;
use App\Http\Resources\ManufacturersResource;

class Manufacturers extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $per_page = $request->has( 'per_page' ) ? $request->get( 'per_page' ) : 5;
        return ManufacturersResource::collection( Manufacturer::paginate( $per_page ) );
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
                'description' => 'required'
            ];

            $manufacturer = new Manufacturer();
            $manufacturer->fill( $request->validate($validate_data) )->save();

            return new ManufacturersResource( $manufacturer );
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
    public function show($id) {
        $manufacturer = Manufacturer::find($id);
        if( !$manufacturer ) {
            return response()->json( 'Invalid ID', Response::HTTP_BAD_REQUEST );
        }

        return new ManufacturersResource($manufacturer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $manufacturer = Manufacturer::find($id);

        if( !$manufacturer ) {
            return response()->json( 'Invalid ID', Response::HTTP_BAD_REQUEST );
        }

        try {
            $manufacturer->title = $request->has('title') ? $request->get('title') : $manufacturer->title;
            $manufacturer->description = $request->has('description') ? $request->get('description') : $manufacturer->description;
            $manufacturer->save();

            return new ManufacturersResource( $manufacturer );
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
        $manufacturer = Manufacturer::find($id);

        if($manufacturer)
            $manufacturer->delete();
        
        return response()->json( NULL, Response::HTTP_NO_CONTENT );
    }
}