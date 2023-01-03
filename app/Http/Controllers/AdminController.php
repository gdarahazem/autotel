<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    public function updateProfile(Admin $admin)
    {
        return view('shared.profile', [
            'user' => $admin
        ]);
    }

    public function storeUpdateProfile(Request $request, Admin $admin)
    {
        {

            $validator = Validator::make($request->all(), [
                'name' => ['max:255', 'required', 'string'],
                'email' => ['email', 'required'],
            ]);

            $attributeNames = array(
                'name' => 'Nom',
                'email' => 'email',
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
                $admin->name = $request->name;
                if ($request->get('new_password') != "" && ($request->get('new_password') == $request->get('new_password_confirmation'))) {
                    $admin->password = Hash::make($request->get('new_password'));
                } else if ($request->get('new_password') != $request->get('new_password_confirmation')) {
                    Alert::warning('Error', "password !");
                    return redirect()->back();
                }
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
                Alert::warning('Error', "Votre modification a été rejeter !");
                return redirect()->back();
            }
        }

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
