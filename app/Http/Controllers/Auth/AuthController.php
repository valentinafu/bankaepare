<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'deactivate']);
    }

    public function redirectToProvider() {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    public function handleProviderCallback() {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from Google provider.")
            : $this->loginOrCreateAccount($user);
    }

    protected function sendSuccessResponse() {
        return redirect()->home();
    }

    protected function sendFailedResponse($msg = null) {
        return redirect()->route('login')
            ->withErrors(['msg' => $msg ?: 'Nuk mund të futeni me këtë email.']);
    }

    public function deactivate(User $user) {

        dd($user);
        $user->update(['active' => 'false']);
        return redirect()->back();
    }

    protected function loginOrCreateAccount($providerUser) {
        // check if user already has an account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found and is not deactivated
        if($user && $user->active == 1) {
            // update the avatar and provider that might have changed
            $user->update([
                'avatar' => $providerUser->getAvatar(),
                'google_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } elseif($user && $user->active == 0) {
            return $this->sendFailedResponse("Kjo llogari është ç'aktivizuar");
        } else {
            // create a new user
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'avatar' => $providerUser->getAvatar(),
                'google_id' => $providerUser->getId(),
                'access_token' => $providerUser->token
            ]);
        }

        // login the user
        auth()->login($user, true);

        return $this->sendSuccessResponse();
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect()->home();
    }
}
