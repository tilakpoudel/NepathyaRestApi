<?php

namespace App\Http\Controllers;

use App\Location;
use App\LocationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::get();

        if($locations->count()==0){
            return response()-> json(['message'=>':( OOPS !!Data not found !!'],404);
        }else{
            return response()->json(['locations'=>$locations],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules= [
            'device_id'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
            'time'=>'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $country = Location::create($request->all());
        return response()->json($country,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location= Location::find($id);
        if(is_null($location)){
            return response()->json(["message"=>":( oops Records not found!!!"],404);
        }
        return response()->json(['data'=>$location], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location= Location::find($id);
        if(is_null($location)){
            return response()->json(["message"=>":( oops Records not found!!!"],404);
        }
        $location->update($request->all());
        return response()->json($location,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location= Location::find($id);
        if(is_null($location)){
            return response()->json('Record not found!!',404);
        }
        $location->delete();
        return response()->json(null,204);
    }

    // get the latest inserted row
    public function getLastLocation(){
        $last_location = DB::table('locations')->latest('created_at')->first();

        return response()->json(['data'=>$last_location],200);

    }
}
