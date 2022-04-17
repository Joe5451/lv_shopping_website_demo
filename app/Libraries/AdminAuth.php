<?php 

namespace App\Libraries;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AdminAuth {
    
    public const HOME = '/admin/login';
    private static $admin = null;
    
    public static function admin(){
        if( empty(self::$admin) && session()->exists('adminId')){
            try {
                $adminId = Crypt::decryptString(session('adminId'));
                self::$admin = Admin::find($adminId);
            } catch (DecryptException $e) {
            }
        }
        return self::$admin;
    }

    public static function isLoggedIn(){
        return !empty(self::admin());
    }

    // public static function signUp(
    //     $account, 
    //     $password,
    //     $password_confirmation
    // ){
    //     if ($password === $password_confirmation){
    //         try {
    //             Admin::create([
    //                 'email' => $email,
    //                 'password' => Hash::make($password),
    //             ]);
    //         } catch (QueryException $e) {
    //             return "Email or password invalid.";
    //         }
    //         return null;
    //     }

    //     return "Password and password confirmation are not compared.";
    // }

    public static function logIn($account, $password){
        $_admin = Admin::where([
            'account' => $account,
        ])->first();

        if (!empty($_admin) && $_admin->password == md5($password)) {
            self::$admin = $_admin;
            session(['adminId' => Crypt::encryptString(self::$admin->admin_id)]);
        }
    }

    public static function logOut(){
        session()->forget('adminId');
        self::$admin = null;
    }
}