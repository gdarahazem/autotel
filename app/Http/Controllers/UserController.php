<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::eloquent(Admin::query()->where('id', '!=', Auth::id()))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . $row->name . '" data-email="' . $row->email . '"
                            class="edit btn tooltipped "  data-bs-placement="right" title="Editer"  data-bs-toggle="modal"
                       data-bs-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';

                    $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . $row->name . '" data-email="' . $row->email . '"
                            class="reset btn  tooltipped "  data-bs-placement="right" title="Changer mot de passe"  data-bs-toggle="modal"
                       data-bs-target="#updatePassword">
                           <i class="fas fa-key text-secondary"></i> </a>';

                    if ($row->status == 0) {
                        $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . "Cliquez sur Oui pour activer l'utilisateur N° " . '"
                            class="desactiver btn tooltipped" data-bs-placement="right" title="Activer" data-bs-toggle="tooltip" >
                             <i class="fas fa-user-check text-primary"></i></a>';
                    } else {
                        if ($row->status == 1) {
                            $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . "Cliquez sur Oui pour désactiver l'utilisateur N° " . '"
                            class="desactiver btn tooltipped" data-bs-placement="right" title="Désactiver" data-bs-toggle="tooltip" >
                            <i class="fas fa-user-times text-danger"></i> </a>';
                        }
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.users');
    }

//    public function editPictures()
//    {
//        $user = Auth::user();
//        return view("admin.administration.edit-picture")->with("user", $user);
//    }


    public function updateLogo(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = Helper::generateApikey() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/logo');
            $img = Image::make($image->path());
            $file = new Filesystem;
            $file->cleanDirectory('images/logo');
            if ($img->resize(400, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename)) {
                Configuration::query()->where("label", "logo")->update(["value" => $filename]);
                Alert::success('Success', "Logo Modifié!");
                return Redirect::back();
            } else {
                Alert::warning('Error', "Erreur modification du Logo");
                return Redirect::back();
            }
        } else {
            Alert::warning('Error', "Aucune photo ajoutée !");
            return Redirect::back();
        }
    }

    public function updateBackground(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = Helper::generateApikey() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/background');
            $img = Image::make($image->path());
            $file = new Filesystem;
            $file->cleanDirectory('images/background');
            if ($img->save($destinationPath . '/' . $filename)) {
                Configuration::query()->where("label", "background")->update(["value" => $filename]);
                Alert::success('Success', "Background Modifié!");
                return Redirect::back();
            } else {
                Alert::warning('Error', "Erreur modification du Background");
                return Redirect::back();
            }
        } else {
            Alert::warning('Error', "Aucune photo ajoutée !");
            return Redirect::back();
        }
    }

    public function update(Request $request, Admin $admin)
    {
//        dd($admin->id);
        $validator = Validator::make($request->all(), [
            'name' => ['max:255', 'required', 'string'],
            'email' => ['email', 'required'],
        ]);

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
            $admin->name = $request->name;
            if ($admin->email != $request->email) {
                $admin->email = $request->email;
                $admin->email_verified_at = null;
            }
            $admin->save();
            DB::commit();
            if ($admin->email_verified_at == null) {
                $admin->sendEmailVerificationNotification();

            }
            Alert::success('Success', "Votre utilisateur a été modifier avec succès !");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre produit a été rejeter !");
            return redirect()->back();
        }
    }

    public function changePassword(Request $request, Admin $admin)
    {

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed'
        ]);
        $attributeNames = array(
            'new_password' => 'Nouveau mot de passe',
        );

        $validator->setAttributeNames($attributeNames);

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
            $admin->password = Hash::make($request->get('new_password'));
            $admin->save();
            DB::commit();
            Alert::success('Success', "Votre demande a été envoyée avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre demande a été rejeter !");
            return redirect()->back();
        }

    }

    public function desactivateAccount(Admin $admin)
    {
        DB::beginTransaction();
        try {
            if ($admin->status == 0) {
                $admin->status = 1;
            } else {
                $admin->status = 0;
            }
            $admin->save();
            DB::commit();
            Alert::success('Success', "Votre compte a été désactiver avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre demande a été rejeter !");
            return redirect()->back();
        }

    }

    public function updateProfile(User $user)
    {
        return view('shared.profile', [
            'user' => $user,
        ]);
    }

    public function storeUpdateProfile(Request $request, User $user)
    {
        {

            $validator = Validator::make($request->all(), [
                'firstName' => ['max:255', 'required', 'string'],
                'lastName' => ['max:8', 'required', 'string'],
                'phone' => ['max:8', 'min:8', 'required', 'string'],
                'email' => ['email', 'required'],
//                'new_password' => 'string|min:8|confirmed'
            ]);

            $attributeNames = array(
                'firstName' => 'Nom',
                'lastName' => 'Prenom',
                'phone' => 'Téléphone',
                'email' => 'email',
//                'new_password' => 'Nouveau mot de passe',
            );

            $validator->setAttributeNames($attributeNames);
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
                $user->first_name = $request->firstName;
                $user->last_name = $request->lastName;
                $user->phone = $request->phone;
                if ($request->get('new_password') != "" && ($request->get('new_password') == $request->get('new_password_confirmation'))) {
                    $user->password = Hash::make($request->get('new_password'));
                } else if ($request->get('new_password') != $request->get('new_password_confirmation')) {
                    Alert::warning('Error', "password !");
                    return redirect()->back();
                }
                if ($user->email != $request->email) {
                    $user->email = $request->email;
                    $user->email_verified_at = null;
                }
                $user->save();
                DB::commit();
                if ($user->email_verified_at == null) {
                    $user->sendEmailVerificationNotification();
                }
                Alert::success('Success', "Votre utilisateur a été modifier avec succès !");
                return redirect()->back();

            } catch (Exception $exception) {
                DB::rollBack();
                Log::error($exception);
                Alert::warning('Error', "Votre produit a été rejeter !");
                return redirect()->back();
            }
        }

    }


    function sendMailToSeller(Request $request, Phone $phone)
    {
        $destination = $request->destination;
        $object = $request->object;
        $description = $request->description;

        $details = [
            'destination' => $destination,
            'object' => $object,
            'description' => $description,

        ];
        $mark = $phone->mark;
//        dd($mark);
        $subject = $object . '(' . $mark . ')';
        \Mail::send('shared.mailForm',
            $details
            , function ($msg) use ($request, $destination, $subject) {
                $msg->from(Auth::user()->email);
                $msg->to($destination);
                $msg->subject($subject);
            });
        Alert::success('Success', "Votre message a été envoyer avec succès !")->persistent("Close");
        return redirect()->back();


    }

    public function editPictures(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('picture-update')) {
            $image = $request->file('picture-update');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/images/avatars/');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $user->photo = $filename;
            DB::beginTransaction();
            try {
                $user->save();
                DB::commit();
                Alert::success('Success', "photo Modifié!");
                return redirect()->back();
            }catch (Exception $exception) {
                DB::rollBack();
                Log::error($exception);
                Alert::warning('Error', "Erreur modification du photo");
                return redirect()->back();
            }
        }
    }
}
