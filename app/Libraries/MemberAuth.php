<?php 

namespace App\Libraries;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class MemberAuth {
    
    public const HOME = '/member/login';
    private static $member = null;
    
    public static function member(){
        if( empty(self::$member) && session()->exists('memberId')){
            try {
                $memberId = Crypt::decryptString(session('memberId'));
                self::$member = Member::find($memberId);
            } catch (DecryptException $e) {
            }
        }
        return self::$member;
    }

    public static function isLoggedIn(){
        return !empty(self::member());
    }

    public static function logIn($email, $password){
        $_member = Member::where([
            'email' => $email,
        ])->first();

        if (!empty($_member) && $_member->password == md5($password)) {
            self::$member = $_member;
            session(['memberId' => Crypt::encryptString(self::$member->member_id)]);
        }
    }

    public static function logOut(){
        session()->forget('memberId');
        self::$member = null;
    }
}