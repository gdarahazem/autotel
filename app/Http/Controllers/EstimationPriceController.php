<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstimationPriceController extends Controller
{
    public function index()
    {
        $marks = Mark::all();
        return view('client.estimate.index', [
            'marks' => $marks,
            "predict" => "",
            "markk" => "",
            "ram" => "",
            'front_camera' => "",
            'back_camera' => "",
            'storage' => "",
            'phones' => []
        ]);
    }

    public function predict(Request $request)
    {
        $marks = Mark::all();
        $mark = $request['mark'];
        $ram = $request['ram'];
        $front_camera = $request['front_camera'];
        $back_camera = $request['back_camera'];
        $storage = $request['storage'];

        $predict = Http::get('http://127.0.0.1:8000/predict/' . $mark . '/' . $ram . '/' . $front_camera . '/' . $back_camera . '/' . $storage)->body();
        $predict = (float)$predict;
        $phones = Phone::query()->whereBetween('price', [$predict-300, $predict+300])->with('photos')->with('user')->get();
        return view("client.estimate.index", [
            'marks' => $marks,
            "predict" => $predict,
            "markk" => $mark,
            "ram" => $ram,
            'front_camera' => $front_camera,
            'back_camera' => $back_camera,
            'storage' => $storage,
            'phones' => $phones
        ]);
    }
}
