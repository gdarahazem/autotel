<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Phone;
use App\Models\Photo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PhoneController extends Controller
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
        'image-uploadify' => ['required'],
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
        'reviews' => 'reviews',
        'processor' => 'processur',
        'image-uploadify' => 'images',
    ];

    public function index(Request $request, $param = null)
    {
        if ($param == "croissant") {
            $phones = Phone::query()->orderBy("price")->with('photos')->with('user')->get();
        } elseif ($param == "decroissant") {
            $phones = Phone::query()->orderBy("price", 'DESC')->with('photos')->with('user')->get();
        } else {

            $phones = Phone::query()->with('photos')->with('user')->get();
        }
        $marks = Mark::all();
        return view('client.posts.index', [
            'phones' => $phones,
            'marks' => $marks
        ]);
    }

    public function myPosts(Request $request)
    {
        $user_id = Auth::id();
        if ($request->ajax()) {
            return Datatables::eloquent(Phone::query()->with("photos")->where("user_id", $user_id))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="' . route("posts.show", ["phone" => $row->id]) . '"
                            class="show btn tooltipped " >
                            <i class="fas fa-eye"></i> </a>';

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"
                    data-name="' . $row->name . '"
                    data-ram="' . $row->ram . '"
                    data-price="' . $row->price . '"
                    data-mark="' . $row->mark . '"
                    data-battery="' . $row->battery . '"
                    data-storage="' . $row->storage . '"
                    data-color="' . $row->color . '"
                    data-frontcamera="' . $row->front_camera . '"
                    data-backcamera="' . $row->back_camera . '"
                    data-description="' . $row->description . '"
                    data-processor="' . $row->processor . '"
                    data-reviews="' . $row->reviews . '"
                            class="edit btn tooltipped "  data-bs-placement="right" title="Editer"  data-bs-toggle="modal"
                       data-bs-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"

                            class="editImage btn tooltipped "  data-bs-placement="right" title="Editer"  data-bs-toggle="modal"
                       data-bs-target="#updateModalImage">
                            <i class="fas fa-camera text-warning"></i> </a>';

                    $btn .= '<a href="javascript:void(0)"  class="delete btn tooltipped" data-id="' . $row->id . '"  data-nom="' . $row->nom . '" data-placement="right" title="Delete">
                            <i class="fas fa-trash-alt text-danger"></i> </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $marks = Mark::all();
        return view('client.posts.myposts', [
            'marks' => $marks
        ]);
    }

    public function show(Request $request, Phone $phone)
    {
        $phone = Phone::query()->with('photos')->where('id', '=', $phone->id)->first();
        return view('client.posts.show', [
            'phone' => $phone
        ]);
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
            $phone = new Phone();
            $phone->name = $request['name'];
            $phone->ram = $request['ram'];
            $phone->mark = $request['mark'];
            $phone->battery = $request['battry'];
            $phone->description = $request['description'];
            $phone->storage = $request['storage'];
            $phone->color = $request['color'];
            $phone->front_camera = $request['frontCamera'];
            $phone->back_camera = $request['backCamera'];
            $phone->processor = $request['processor'];
            $phone->reviews = $request['reviews'];
            $phone->price = $request['price'];
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

    public function update(Request $request, Phone $phone)
    {

        DB::beginTransaction();
        try {
            $phone->name = $request['name'];
            $phone->ram = $request['ram'];
            $phone->mark = $request['mark'];
            $phone->battery = $request['battry'];
            $phone->description = $request['description'];
            $phone->storage = $request['storage'];
            $phone->color = $request['color'];
            $phone->front_camera = $request['frontCamera'];
            $phone->back_camera = $request['backCamera'];
            $phone->processor = $request['processor'];
            $phone->reviews = $request['reviews'];
            $phone->price = $request['price'];
            DB::commit();
            Alert::success('Success', "Votre téléphone a été modifier avec succès !")->persistent("Close");
            $phone->save();
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre téléphone a été rejeter !");
            return redirect()->back();
        }
    }

    public function updateImage(Request $request, Phone $phone)
    {

        $phone = Phone::query()->with('photos')->where('user_id', "=", $phone->user_id)->first();
//        dd($phone->photos[0]);
        $ids = $phone->photos()->pluck("id");

        DB::beginTransaction();
        try {

            if ($request->hasFile('image-uploadify')) {
                $imageCounter = count($request->file('image-uploadify'));
                Photo::query()->whereIn('id', $ids)
                    ->delete();
                DB::commit();
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

            Alert::success('Success', "Votre images a été modifier avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre images a été rejeté !");
            return redirect()->back();
        }

    }

    public function searchProductByName($search)
    {
        $phones = Phone::query()
            ->where("name", "like", "%" . $search . "%")
            ->orWhere("mark", "like", "%" . $search . "%")
            ->with('photos')
            ->with('user')->get();
        $marks = Mark::all();
        return view('client.posts.index', [
            'phones' => $phones,
            'marks' => $marks
        ]);
    }

    public function delete(Phone $phone)
    {
        DB::beginTransaction();
        try {
            $phone->delete();
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

    public function phonesListeWithSearch(Request $request, $param = null)
    {
        if ($param == "croissant") {
            $phones = Phone::query()->orderBy("price")->with('photos')->with('user')->get();
        } elseif ($param == "decroissant") {
            $phones = Phone::query()->orderBy("price", 'DESC')->with('photos')->with('user')->get();
        } else {

            $phones = Phone::query()->with('photos')->with('user')->get();
        }
        $marks = Mark::all();
        return view('client.posts.index', [
            'phones' => $phones,
            'marks' => $marks
        ]);
    }

}
