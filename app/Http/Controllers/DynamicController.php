<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    //
    public function fetch(Request $request){
        // dd($request->all());
        $device_id = $request->get('deviceId');
        // $device_coordinate = Location::where('device_id',$device_id)->get();

        $device_coordinate = Location::where('device_id',$device_id)->latest('time')->first();
        // $model->where('created_at', '=', ?)->orderBy('id', 'desc')->take(1)->first();

        return $device_coordinate;

        // if($dependent == 'nirdeshanalaya_id'){
        //     $data = Nirdeshanalaya::where('status',1)
        //         ->where($select,$value)
        //         ->get();
        //     $output = '<option value = ""> निर्देशानालय छान्नुहोस् </option>';
        //     foreach($data as $row){
        //         $output .= '<option value = "'.$row->id.'">'.$row->nir_name.'</option>';
        //     }
        // }
    }
}
