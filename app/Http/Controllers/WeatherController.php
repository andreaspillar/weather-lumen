<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Weathers;

class WeatherController extends Controller
{
    public function add(Request $request)
    {
        try {
            $weather = new Weathers();
            $weather->city = $request->input('city');
            $weather->details = $request->input('details');
            $weather->save();
            return response()->json(["message" => "success"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "something bad happen, can't save"], 409);
        }
    }

    public function retrieveAll()
    {
        $retrieve = Weathers::get();
        return response()->json(["data" => $retrieve], 200);
    }

    public function retrieveId($id)
    {
        $retrieve = Weathers::where('id', $id)->get();
        return response()->json(["data" => $retrieve], 200);
    }
}