<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Session; 

use Illuminate\Http\Request;

use App\Helpers\Contracts\HelperContract; 
use App\BankDetails;
use App\AccountStatus;
use App\Referrals;
use App\Packages;
use App\Donations;
use App\Tickets;
use App\News;
use App\SiteMessages;
use App\Pool; 
use App\PoolPosition; 
use App\PaymentInformation; 
use App\User; 
use App\Pins;

class LoginController extends Controller {

    protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;
    }
    
	public function getLogin()
    {
         return view('login');
    }
    
    public function postLogin(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'password' => 'required|min:6',
                             'username' => 'required|min:5|exists:users'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
             
             $ret = "<div class='alert alert-danger'><strong>Whoops!</strong> There were some problems signing you in.<br><br>";
             $ret .= "<ul>";
					
             foreach($messages->all() as $error) $ret .= "<li>".$error."</li>";
            
             $ret .= "</ul></div>";
         }
         
         else
         {
         	//authenticate this login
            if(Auth::attempt(['username' => $req['username'],'password' => $req['password']]))
            {
            	//Login successful
                
            $user = Auth::user();
            
            //get account status
            $as = AccountStatus::where("user_id",$user->id)-> first();
            
            if($as->enabled == "no")
            {
            	$ret = "disabled";
                $this->getLogout();
            }
            
            else if($as->verified == "no")
            {
            	$ret = "unverified";
                $this->getLogout();
            }
            
            else if($as->activated == "no")
            {
            	$this->helpers->setUserStatus($user,"R2");
            	$ret = "deactivated";
            }
            
            else
            {
            	$ret = "ok";
                 $user->online = "yes";
                $user->save();
            }
           
           
           if($user->role == "superadmin"){$ret = "admin";}
            }
            
            else{ $ret = "invalid";}
         }
         
        return $ret;         
    }
    
    public function getRegisterStep0()
    {
         return view('register-step-0');
    }
    
    public function postRegisterStep0(Request $request)
    {
    	$req = $request->all();
         #dd($req);
         
         #check if user has registered before
         $preUser = User::where('email', $req["email"])->first();
             
        if($preUser == null){
         
           $validator = Validator::make($req, [
                             'email' => 'required|email', 
                             'fname' => 'required',
                             'lname' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
         	$user =  $this->helpers->createUserStep0($req); 
              $req["user_id"] = $user->id; $req["package"] = 0;
             $this->helpers->createAccountStatus($req);
             $up = url("verify/id")."/".$user->id;
             $this->helpers->sendEmail($user->email,'Verify Your FundsForLife Account',['email' => $user->email, 'id' => $user->id,'url' => $up],'emails.verify','view');
              Session::flash("grepo", $user->id);
              $user->update(['stage' => "1"]);
              Session::flash("step-0-status", "success");
              return redirect()->intended('register-step-0');           
         }
         
       } 
       
       else{
           #dd($preUser);
           $stage = $preUser->stage;
           Session::flash("grepo",$preUser->id);
           $u = "register-step-".$stage."/?grepo=".$preUser->id;
           return redirect()->intended($u);           
      }
    }
    
    public function getRegisterStep1(Request $request)
    {
    	$req = $request->all();
    
         $validator = Validator::make($req, [
                             'grepo' => 'required'
         ]);
         
         if($validator->fails())
         {                     
             return redirect()->intended('register-step-0');
         }
         
         else 
         {
         	$grepo = $req['grepo'];
         	return view('register-step-1', compact(['grepo']));
         }
         
    
    }
    
    public function postRegisterStep1(Request $request)
    {
    	$req = $request->all();
         #dd($req);
         
         $validator = Validator::make($req, [
                             'number' => 'required|exists:pins',
                             'grepo' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
         	$user =  User::where('id',$req['grepo'])->first(); 
              $status = "fail";
              $pin = Pins::where('number',$req['number'])->first();
              $status = $this->helpers->useActivationPin($user, $pin);
              Session::flash("grepo", $user->id);
              Session::flash("step-1-status", $status);
              $user->update(['stage' => "2"]);
              $u = "register-step-1/?grepo=".$user->id;
              return redirect()->intended($u);            
         }
    }
    
    public function getRegisterStep2(Request $request)
    {
         $req = $request->all();
    
         $validator = Validator::make($req, [
                             'grepo' => 'required'
         ]);
         
         if($validator->fails())
         {                     
             return redirect()->intended('register-step-0');
         }
         
         else 
         {
         	$grepo = $req['grepo'];
         	return view('register-step-2', compact(['grepo']));
         }
         
    }
    
    public function postRegisterStep2(Request $request)
    {
    	$req = $request->all();
         #dd($req);
         
         $validator = Validator::make($req, [
                             'phone' => 'required', 
                              'grepo' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$number = $req['phone'];
                 	$user =  User::where('id',$req['grepo'])->first(); 
                     $user->update(['phone' => $number]);
                     
                     //send OTP
                 	#$number = "09078416398";
                 	#$this->helpers->sendOTP($number);
                     $this->helpers->sendPhoneVerificationEmail($number);
                 
                     Session::flash("grepo", $user->id);
                      Session::flash("step-2-status", "success");
                      $user->update(['stage' => "3"]);
                      $u = "register-step-2/?grepo=".$user->id;
                     return redirect()->intended($u);            
                 }
    }
    
    public function getRegisterStep3(Request $request)
    {
         $req = $request->all();
    
         $validator = Validator::make($req, [
                             'grepo' => 'required'
         ]);
         
         if($validator->fails())
         {                     
             return redirect()->intended('register-step-0');
         }
         
         else 
         {
         	$grepo = $req['grepo'];
         	return view('register-step-3', compact(['grepo']));
         }
         
    }
    
    public function postRegisterStep3(Request $request)
    {
    	$req = $request->all();
         #dd($req);
         
         $validator = Validator::make($req, [
                             'vcode' => 'required', 
                             'grepo' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$user =  User::where('id',$req['grepo'])->first();                   
                     
                     #verify vcode
                     if($user->vcode == $req['vcode'])
                      {
                      	$status = "success";
                      }
                      
                      else
                      {
                      	$status = "fail";
                      }
                     Session::flash("grepo", $user->id);
                     Session::flash("step-3-status", $status);
                     $user->update(['stage' => "4"]);
                      $u = "register-step-3/?grepo=".$user->id;
                     return redirect()->intended($u);            
                 }
    }
    
    public function getRegisterStep4(Request $request)
    {
    	$req = $request->all();
    
         $validator = Validator::make($req, [
                             'grepo' => 'required'
         ]);
         
         if($validator->fails())
         {                     
             return redirect()->intended('register-step-0');
         }
         
         else 
         {
         	$grepo = $req['grepo'];
             $availablePackages = $this->helpers->getPackages();
         	return view('register-step-4', compact(['grepo','availablePackages']));
         }
    }
    
    public function postRegisterStep4(Request $request)
    {
    	$req = $request->all();
         #dd($req);
         
         $validator = Validator::make($req, [
                             'bname' => 'required',
                             'acname' => 'required',
                             'acno' => 'required|numeric',
                             'plan' => 'required',
                             'grepo' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$as =  AccountStatus::where('user_id',$req['grepo'])->first();                   
                     $user =  User::where('id',$req['grepo'])->first();                   
                     #update package
                     $as->update(['package_id' => $req['plan']]);
                     $req['user_id'] = $req['grepo'];
                      $this->helpers->createBankDetails($req);
                      
                      $req['package'] = $req['plan']; $p = Packages::where('id',$req['package'])->first();
            $req['next'] = "no";
            $req['remain'] = "no";            
            $req['amount'] = 0;
            $req['priority'] = $this->helpers->GetGHPriorityNumber();
             $this->helpers->createPoolPosition($req);

                     Session::flash("grepo", $user->id);
                     Session::flash("step-4-status", "success");
                     $user->update(['stage' => "5"]);
                      $u = "register-step-4/?grepo=".$user->id;
                     return redirect()->intended($u);            
                 }         
    }
    
    public function getRegisterStep5(Request $request)
    {
         $req = $request->all();
    
         $validator = Validator::make($req, [
                             'grepo' => 'required'
         ]);
         
         if($validator->fails())
         {                     
             return redirect()->intended('register-step-0');
         }
         
         else 
         {
         	$grepo = $req['grepo'];
         	return view('register-step-5', compact(['grepo']));
         }
    }
    
    public function postRegisterStep5(Request $request)
    {
    	$req = $request->all();
        # dd($req);
         
       $validator = Validator::make($req, [
                             'username' => 'required|min:5|unique:users',
                             'pass' => 'required|confirmed',
                             'g-recaptcha-response' => 'required',
                             'grepo' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$user =  User::where('id',$req['grepo'])->first();                   
                     
                     #update username
                     $user->update(['username' => $req['username'] , 'password' => bcrypt($req['pass'])] );

                     Session::flash("grepo", $user->id);
                     Session::flash("step-5-status", "success");
                      $u = "register-step-5/?grepo=".$user->id;
                     return redirect()->intended($u);            
                 }         
    }
    
    public function getRegister($pid = "")
    {
    	 $availablePackages = $this->helpers->getPackages();
          if($pid != "") Session::flash("pid",$pid);
         return view('register', compact(['availablePackages']));
    }
    
    public function getForgotUsername()
    {
         return view('forgot_username');
    }
    
/**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotUsername(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'email' => 'required|email'
                  ]);
                  
                 if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['email'];

                $user = User::where('email',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("This user doesn't exist!","errors"); 
                }
                
                $this->helpers->sendEmail($user->email,'Your Username',['username' => $user->username],'emails.username','view');                                                         
            Session::flash("reset-status","success");           
            return redirect()->intended('forgot-username');

      }
                  
    }    
    
    
    public function postCheckUsername(Request $request)
   {
   	$req = $request->all();
        $ret = "";
       $check = $this->helpers->checkUsername($req['username']);
       if($check == "yes") $ret = "<strong><span class = 'text-success'>Username is available!</span></strong>";
       else if($check == "no") $ret = "<strong><span class = 'text-danger'>Username is available!</span></strong>";
       
       return $ret;
   }
   
   public function getVerify($id="")
    {
    	if($id == ""){} 
        else
        {
        	 //get account status
            #$user = User::where('id',"61")->first();
           # $req["user_id"] = $user->id; $req["package"] = 0;
          #   $this->helpers->createAccountStatus($req);
            $as = AccountStatus::where("user_id",$id)->first();
            #dd($as);
            #Session::flash("grepo",$id);           
            Session::flash("verify-status","success");           
           $as->update(["verified" => "yes"]);
        } 
        $u = "register-step-1/?grepo=".$id;
         return redirect()->intended($u);
    }
    
    public function postRegister(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'username' => 'required|min:5|unique:users',
                             'email' => 'required|email',
                             'fname' => 'required',
                             'lname' => 'required',
                             'phone' => 'required|numeric',
                             'bname' => 'required',
                             'acname' => 'required',
                             'acno' => 'required|numeric',
                             'pass' => 'required|confirmed',
                             'plan' => 'required',
                             'g-recaptcha-response' => 'required',
                           # 'terms' => 'accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
            $req['package'] = $req['plan']; $p = Packages::where('id',$req['package'])->first();
            $req['next'] = "no";
            $req['remain'] = "no";            
            $req['amount'] = 0;
            $req['priority'] = $this->helpers->GetGHPriorityNumber();
            
                       #dd($req);            

            $user =  $this->helpers->createUser($req); 
            $req['user_id'] = $user->id;
            
             $this->helpers->createBankDetails($req);
             $this->helpers->createAccountStatus($req);
             $this->helpers->createPoolPosition($req);
         
             //after creating the user, send back to the registration view with a success message
             $this->helpers->sendEmail($user->email,'Verify Your FundsForLife Account',['username' => $user->username, 'id' => $user->id],'emails.verify','view');
             Session::flash("signup-status", "success");
             return redirect()->intended('register');
          }
    }
    
    
    public function getLogout()
    {
        if(Auth::check())
        {
           //$req = $request->all();
           $user = Auth::user();
           $user->online = "no";
           $user->save();
           
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}
