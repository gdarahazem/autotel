<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Phone;
use App\Models\PhonesSearch;
use App\Models\Photo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class PhonesSearchesController extends Controller
{
    private $validator = [
        'name' => ['min:2', 'string', 'required'],
        'ram' => ['numeric', 'required'],
        'mark' => ['string', 'required'],
        'description' => ['min:2', 'string', 'required'],
        'battry' => 'numeric',
        'storage' => 'numeric',
        'color' => ['string', 'required'],
        'frontCamera' => 'numeric',
        'backCamera' => 'numeric',
    ];
    private $attributeNames = [
        'name' => 'nom',
        'ram' => 'ram',
        'mark' => 'marque',
        'description' => 'description',
        'battry' => 'battrie',
        'storage' => 'stoukage',
        'color' => 'coleur',
        'frontCamera' => 'caméra avant',
        'backCamera' => 'caméra arrière',
        'processor' => 'processur',
    ];


    public function index(Request $request, $param = null)
    {
//        dd("hello");
        if ($param == "croissant") {
            $phones = PhonesSearch::query()->orderBy("mark")->with('user')->get();
        } elseif ($param == "decroissant") {
            $phones = PhonesSearch::query()->orderBy("mark", 'DESC')->with('user')->get();
        } else {
            $phones = PhonesSearch::query()->with('user')->get();
        }
        $marks = Mark::all();
        return view('client.post_search.index', [
            'phones' => $phones,
            'marks' => $marks
        ]);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validator);
        $validator->setAttributeNames($this->attributeNames);

        if ($validator->errors()->any()) {
            $text = "";
            foreach ($validator->errors()->all() as $error) {
                $text = $error . "\n";
            }

            Alert::warning('Error', $text);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $phone = new PhonesSearch();
            $phone->name = $request['name'];
            $phone->ram = $request['ram'];
            $phone->mark = $request['mark'];
            $phone->battery = $request['battry'];
            $phone->description = $request['description'];
            $phone->storage = $request['storage'];
            $phone->color = $request['color'];
            $phone->processor = $request['processor'];
            $phone->user_id = Auth::id();
            $phone->save();

            if ($request->hasFile('image-uploadify')) {
                $imageCounter = count($request->file('image-uploadify'));
                for ($i = 0; $i < $imageCounter; $i++) {
                    $image = $request->file('image-uploadify')[$i];
                    $filename = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/images/phones');
                    $img = Image::make($image->path());
                    $img->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . '/' . $filename);
                    $photo = new Photo();
                    $photo->phone_id = $phone->id;
                    $photo->src = $filename;
                    $photo->save();
                }

            }
            DB::commit();

            Alert::success('Success', "Votre téléphone a été modifier avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre téléphone a été rejeté !");
            return redirect()->back();
        }
    }

    public function show(Request $request, PhonesSearch $phonesSearch)
    {

        return view('client.post_search.show', [
            'phone' => $phonesSearch
        ]);
    }

    public function phonesListeWithSearch(Request $request, $param = null)
    {
        if ($param == "croissant") {
            $phones = PhonesSearch::query()->orderBy("price")->with('user')->get();
        } elseif ($param == "decroissant") {
            $phones = PhonesSearch::query()->orderBy("price", 'DESC')->with('user')->get();
        } else {

            $phones = PhonesSearch::query()->with('user')->get();
        }
        $marks = Mark::all();
        return view('client.post_search.index', [
            'phones' => $phones,
            'marks' => $marks
        ]);
    }


    public function edit(PhonesSearch $phonesSearch)
    {
        //
    }

    public function update(Request $request, PhonesSearch $phonesSearch)
    {
        //
    }

    public function destroy(PhonesSearch $phonesSearch)
    {
        DB::beginTransaction();
        try {
            $phonesSearch->delete();
            DB::commit();
            Alert::success('Success', "Votre téléphone a été supprimer avec succès !")->persistent("Close");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre téléphone a été rejeter !");
            return redirect()->back();
        }
    }
}
