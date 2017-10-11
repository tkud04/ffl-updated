<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Helpers\Contracts\HelperContract; 
use App\User;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Session; 

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;
	
	protected $redirectTo = '/dashboard';
	
	protected $helpers; //Helpers implementation
	protected $subject;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords, HelperContract $h, TokenRepositoryInterface $t)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;
		$this->helpers = $h;
		$this->tokens = $t;
		$this->subject = 'Your Password Reset Link';

		$this->middleware('guest');
	}
	
	
/**
     * Shows the' Reset Password' view
     * @param  \Illuminate\Http\Request  $request
     */
    public function getEmail(Request $request)
    {
    	return view('auth.password');
    } 
/**
     * Send a reset link to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
                $req = $request->all(); $ret = $req['email'];

                $user = User::where('email',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("This user doesn't exist!","errors"); 
                }

                $token = $this->tokens->create($user);

            $this->helpers->sendEmail($user->email,$this->subject,['token' => $token],'emails.password','view');                                                         
            Session::flash("reset-status","success");           
            return redirect()->intended('forgot-password');
    }

}
