<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
// use GuzzleHttp\Psr7\Request;


class AdminLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $headers = ['content-type'=>'application/json','AUTH_KEY' => 'NEPATHYATILAK'];
        // $client = new Client();

        // $url ='http://www.itandrc.com/NepathyaRestApi/api/location';
        // try {
        //     $res = $client->get($url, ['header'=>$headers]);
        //     echo $res->getStatusCode(); // 200
        //     echo $res->getBody();
        //     dd($res->getBody());    //code...
        // } catch (Exception $e) {
        //     throw $e;
        // }


        $locations = Location::get();
        return view('admin.locations.index')->with('locations', $locations);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
