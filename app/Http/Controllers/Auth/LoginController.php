<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic 
        // $user = Socialite::driver($provider)->stateless()->user();
        // return response()->json($user);

        // return Socialite::driver('google')->redirect();

        return Socialite::driver('google')->redirect();
        
    }

    public function index()
    {
        try {
            $user = Socialite::driver('google')->user();

        // $user->token;
        // echo $user->name;
        // dd($user->user['given_name']);

        $finduser = User::where('google_user_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/');
            } else {
                $NewUser = new User;
                $NewUser->status = 1;
                $NewUser->email = $user->email;
                $NewUser->name  = $user->name;
                $NewUser->image  = $user->avatar;
                $NewUser->google_user_id  = $user->id;
                $NewUser->password  = rand(10000000,99999999);
                $NewUser->save();

                Auth::login($NewUser);
                return redirect('/');
            }

        } catch (Exception $e) {
            dd('Somethig Went Wrong! or You Are Blocked!');
            dd($e->getMessage());
        }
    }
}
