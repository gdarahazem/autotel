<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        return view('client.budget.index', [
            "budget" => "",
            "phones" => []
        ]);
    }
    public function budget(Request $request) {
        $b = $request['budget'];
        $phones = Phone::query()->whereBetween('price', [$b-300, $b+300])->with('photos')->with('user')->get();
        return view('client.budget.index', [
            "budget" => $b,
            "phones" => $phones
        ]);
    }
}
