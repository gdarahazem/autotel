<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class MarksController extends Controller{

    private $validator = [
        'nom' => ['min:2', 'required', 'string']
    ];
    private $attributeNames = [
        'nom' => 'Nom',
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::eloquent(Mark::query())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . $row->name . '"
                            class="edit btn tooltipped "  data-bs-placement="right" title="Editer"  data-bs-toggle="modal"
                       data-bs-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';

                    $btn .= '<a href="javascript:void(0)"  class="delete btn tooltipped" data-id="' . $row->id . '"  data-nom="' . $row->nom . '" data-placement="right" title="Delete">
                            <i class="fas fa-trash-alt text-danger"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.mark.mak');
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
            $mark = new Mark();
            $mark->name = $request['nom'];
            $mark->save();
            DB::commit();
//            Cache::tags('pct_code')->flush();
            Alert::success('Success', "Votre marque a été ajouter avec succès !")->persistent("Close");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre marque a été rejeter !");
            return redirect()->back();
        }

    }

    public function update(Request $request, Mark $mark)
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
            $mark->name = $request['nom'];
            $mark->save();
            DB::commit();
            Alert::success('Success', "Votre marque a été modifier avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre marque a été rejeter !");
            return redirect()->back();
        }
    }

    public function destroy(Mark $mark)
    {
        DB::beginTransaction();
        try {
            $mark->delete();
            DB::commit();
            return Response::json(["error" => false, "message" => "Opération effectuée avec succés"], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            return Response::json(["error" => true, "message" => "Une Erreur est servenue ,veuillez réesayer plus tard"], 200);
        }
    }

}
