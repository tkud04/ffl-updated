<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session; 

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use App\User;
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
use App\SliderImages; 
use App\Countdown; 
use App\Notifications; 
use App\Pins; 
use Validator; 
use Carbon\Carbon; 
use App\MessageBird\Client;

class MainController extends Controller {
	
	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->helpers->getAuthenticatedUser();
		#dd($user);
		$sliders = null;
		#$sliders = $this->helpers->getSliderImages();
		#shuffle($sliders);
		$availablePackages = $this->helpers->getPackages();
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		
		$sliderTexts = ["Naija's very own<br>Peer-to-peer donation platform<br>","Naija's very own<br>Peer-to-peer donation platform<br>","Naija's very own<br>Peer-to-peer donation platform<br>","Naija's very own<br>Peer-to-peer donation platform<br>","Naija's very own<br>Peer-to-peer donation platform<br>"];
		$sliderSubtexts = ["GET 50% OF YOUR DONATION","GET 50% OF YOUR DONATION","GET 50% OF YOUR DONATION","GET 50% OF YOUR DONATION"];
		
		$header = ["It's a group of willing donors with big hearts coming together to selflessly help each other financially with their spare funds with no conditions attached. This is done bearing in mind the principle of sowing and reaping, gratuitousness, reciprocity and benevolence.","The goal is to willingly help one another overcome the world's unjust financial system that helps the rich to get richer while the poor get poorer. For believers to help one another achieve their dreams."];
		$footer = ["The goal is to willingly help one another overcome the world's unjust financial system that helps the rich to get richer while the poor get poorer. For believers to help one another achieve their dreams."];
		
		 $ret = $this->helpers->getNews("all");
		return view('index', compact(['user','sliders','availablePackages','sliderTexts','sliderSubtexts','header','footer','sidebarUpdates','ret']));
	}
	
	
	/**
	 * Show the application "How It Works" screen to the user.
	 *
	 * @return Response
	 */
	public function getHowItWorks()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('how-it-works', compact(['user','sidebarUpdates']));
	}
	
	/**
	 * Show the application "Coming Soon" screen to the user.
	 *
	 * @return Response
	 */
	public function getComingSoon()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('coming_soon', compact(['user','sidebarUpdates']));
	}
	
	/**
	 * Show the application "Warning" screen to the user.
	 *
	 * @return Response
	 */
	public function getWarning()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$purpose = "w";
		$title  = "WARNING";
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('legal', compact(['user','purpose','title','sidebarUpdates']));
	}
	
	/**
	 * Show the application "Terms and Conditions " screen to the user.
	 *
	 * @return Response
	 */
	public function getTerms()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$purpose = "t";
		$title  = "TERMS AND CONDITIONS";
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('legal', compact(['user','purpose','title','sidebarUpdates']));
	}
	
	/**
	 * Show the application "Privacy Policy " screen to the user.
	 *
	 * @return Response
	 */
	public function getPrivacyPolicy()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$purpose = "pp";
		$title  = "PRIVACY POLICY";
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('legal', compact(['user','purpose','title','sidebarUpdates']));
	}
	
	
	/**
	 * Show the application "Vendors" screen to the user.
	 *
	 * @return Response
	 */
	public function getVendors()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('vendor-list', compact(['user','sidebarUpdates']));
	}
	
	/**
	 * Show the application "Contact Us " screen to the user.
	 *
	 * @return Response
	 */
	public function getContact()
	{
		$user = $this->helpers->getAuthenticatedUser();
		$name = $user->first_name." ".$user->last_name;
		$email = $user->email;
		$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
		return view('contact', compact(['user','sidebarUpdates','name','email']));
	}
	
	/**
	 * Handles contact messages
	 *
	 * @return Response
	 */
	public function postContact()
	{
	 if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();
           dd($req);

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     
                $validator = Validator::make($req, [
                             'subject' => 'required',
                             'message' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$ticket_id = $this->helpers->createTicketID($user);
                     
                     #dd($ticket_id);
                     $ticket = Tickets::create(['user_id' => $user->id, 'ticket_id' => $ticket_id, 'status' => 'pending', 'subject' => $req['subject'],'message' => $req['message']]);
                     Session::flash("create-ticket-status", "success");
                     return redirect()->intended('support');            
                 }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
	}
	
	
	/**
	 * Shows the user Dashboard.
	 *
	 * @return Response
	 */
    public function getDashboard()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           
        

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {
           	//dd($user);
               $counter = null; 
               $sidebarUpdates = $this->helpers->getSidebarUpdates($user); 
               $availablePackages = $this->helpers->getPackages();
               $pin = Pins::whereRaw("used_by = ? and valid =  'yes'",[$user->id])->first();
           
               //get the account status
               $accountStatus = AccountStatus::where('user_id', $user->id)->first();
               $ret = null;
              #dd($accountStatus);
               //if the user is R, display the recycle view
                 if($accountStatus->status == "R")
                 {
                 	  //get the count down
                      $t1 = Carbon::parse($accountStatus->updated_at);
                      $t1 = $t1->addHours(12);
                      $t2 = Carbon::now();
                      $a = $t2->gt($t1);
                     if($a == true){
                     	$this->getBlock();
                      }             
                 	return view('recycle', compact(['user','ret','accountStatus','counter','availablePackages','sidebarUpdates']));
                 }
               
                //if the user is PH and has not been merged, do so and return partners details
               else if($accountStatus->status == "PH")
               {
                   if($accountStatus->merged == "no")
                   {
                        $p = Packages::where('id',$accountStatus->package_id)->first();
                        $status = $this->helpers->merge($user,$p->id);
                        
                        if($status == "success") 
                         {
                           Session::flash("redirect-status","success");
                           return redirect()->intended('/'); 
                         } 
                         
                        else if($status == "fail") 
                         {
                         #  return redirect()->intended('/'); 
                         } 
                   }
                   
                   else if($accountStatus->merged == "yes")
                   {
                   	$ret = $this->helpers->getMergedReceiver($user);
                      
                      //get the count down
                      $t1 = Carbon::parse($accountStatus->updated_at);
                      $t1 = $t1->addHours(6);
                      $t2 = Carbon::now();
                      $a = $t2->gt($t1);
                      #dd($a);
                     if($a == true){
                         $giver = $user;
                     	$d  = Pool::where('giver_id', $giver->id)->where('receiver_id', $ret['user_id'])->where('amount', $ret['amount'])->where('status', 'pending_confirmation')->first();
                         $tempo = array("d" => $d, "giver" => $giver);
                         #dd($tempo);
                         
                         if($giver != null && $d != null)
                         {
                         	#dd($d);
                           $this->helpers->confirm($d, $giver);                                                                                
                           #dd($d);
                       	Session::flash("confirm-pay-status", "success");
                           return redirect()->intended('dashboard');                               	
                         } 
                         else
                          {
                     	   $this->getBlock();
                          } 
                      }             
                   }             	
                                     
               }
               
               //if the user is R2 display the buy activation pin view
               else if($accountStatus->status == "R2")
               {

                           //get the count down
                      $t1 = Carbon::parse($accountStatus->updated_at);
                      $t1 = $t1->addHours(25);
                      $t2 = Carbon::now();
                      $a = $t2->gt($t1);
                     if($a == true){
                     	$this->getBlock();
                      }        
                      else{    
                 	return view('r2', compact(['user','ret','accountStatus','counter','availablePackages','sidebarUpdates']));
                     } 
               }
               
               else if($accountStatus->status == "GH")
               {
                   if($accountStatus->merged == "no")
                   {
                   	
                   }
                   
                   else if($accountStatus->merged == "yes")
                   {
                   	$ret = $this->helpers->getMergedGivers($user);
                      # dd($ret);
                   }                	
                                     
               }
               
               else if($accountStatus->status == "GH-E")
               {
                   if($accountStatus->merged == "no")
                   {
                   	
                   }
                   
                   else if($accountStatus->merged == "yes")
                   {
                   	$ret = $this->helpers->getMergedGivers($user);
                      # dd($ret);
                   }             
                                     
               }
               
               else if($accountStatus->status == "GH-O")
               {
                   if($accountStatus->merged == "no")
                   {
                        $p = Packages::where('id',$accountStatus->package_id)->first();
                        $status = $this->helpers->merge($user,$p->id);
                        
                        if($status == "success") 
                         {
                           Session::flash("redirect-status","success");
                           return redirect()->intended('/'); 
                         } 
                         
                        else if($status == "fail") 
                         {
                         #  return redirect()->intended('/'); 
                         } 
                   }
                   
                   else if($accountStatus->merged == "yes")
                   {
                   	$ret = $this->helpers->getMergedReceiver($user);
                      
                 	  //get the count down
                      $t1 = Carbon::parse($accountStatus->updated_at);
                      $t1 = $t1->addHours(6);
                      $t2 = Carbon::now();
                      $a = $t2->gt($t1);
                      
                      if($a == true){
                         $giver = $user;
                     	$d  = Pool::where('giver_id', $giver->id)->where('receiver_id', $ret['user_id'])->where('amount', $ret['amount'])->where('status', 'pending_confirmation')->first();
                         $tempo = array("d" => $d, "giver" => $giver);
                         #dd($tempo);
                         
                         if($giver != null && $d != null)
                         {
                         	#dd($d);
                           $this->helpers->confirm($d, $giver);                                                                                
                           #dd($d);
                       	Session::flash("confirm-pay-status", "success");
                           return redirect()->intended('dashboard');                               	
                         } 
                         else
                          {
                          	dd($a);
                     	   $this->getBlock();
                          } 
                      }                 
                   }             	
                                     
               }
               
               
               # get the dashboard stats
               $stats = $this->helpers->getDashboardStats($user);
               $rph = $this->helpers->getRecentPaymentHistory($user);
               
               #$stats = ["total_paid" => "1,300,000", "monthly_received" => "740,000", "cycles_completed" => "70"];
               
               
               #dd($rph);
               return view('dashboard', compact(['user','ret','accountStatus','counter','sidebarUpdates','stats','rph','pin']));
           }
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    /**
	 * Show the application "R2" screen to the user.
	 *
	 * @return Response
	 */
	public function getR2()
	{
		$user = $this->helpers->getAuthenticatedUser();
		return redirect()->intended('dashboard'); 
	}
    
    
    /**
	 * Activates a deactivated user
	 *
	 * @return Response
	 */
    public function postR2(Request $request)
    {
    	$req = $request->all();
         #dd($req);
         $user = $this->helpers->getAuthenticatedUser();
         
         $validator = Validator::make($req, [
                             'number' => 'required|exists:pins',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
              $status = "fail";
              $pin = Pins::where('number',$req['number'])->first();
              $status = $this->helpers->useActivationPin($user, $pin);
              $s = "PH"; 
          	if($user->role == "special") $s = "GH"; 
      	    $this->helpers->setUserStatus($user, $s);

              Session::flash("r2-status", $status);
              $u = "r2";
              return redirect()->intended($u);            
         }
    }    
    
    
    
    /**
	 * Updates the user Counter.
	 *
	 * @return Response
	 */
    public function postCounter(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {          	
                
                   $counter = Countdown::where('user_id', $user->id)->first();
                   
                    if($counter == null)
                    {
                  	$counter = new Countdown;
                      $counter->user_id = $user->id;    

                      $counter->purpose = "ph";
                      $counter->started_at = Carbon::now();             
                      $counter->save();                  
                    }
                    
                    else
                    {
                    	$counter->touch();
                    } 
                    
                   
           
                    $ret = "Countdown updated successfully";
                     return $ret;            
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    public function getDonations()
    {
    	if(Auth::check())
        {
        	$user = Auth::user();
            //dd($user);
            if($user->role == "")
            {
            	$donations = $this->helpers->getDonations($user);
                $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
                #dd($donations);
                $names = array();
                
                if($donations->count() > 0)
               {
               	foreach($donations as $d)
                   {
                   	$giver = User::where('id', $d->giver_id)->first();
                        $receiver = User::where('id', $d->receiver_id)->first();
                        if(!isset($names[$giver->id])) $names[$giver->id] = $giver->first_name." ".$giver->last_name;
                        if(!isset($names[$receiver->id])) $names[$receiver->id] = $receiver->first_name." ".$receiver->last_name;
                   }
               }
                
                return view('donations', compact(['user','donations','names','sidebarUpdates']));
            }
            
            else {}
        }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    
    /**
	 * Shows the user Transactions.
	 *
	 * @return Response
	 */
    public function getTransactions()
    {
        if(Auth::check())
       {
       	$user = Auth::user();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {
           	$transactions = $this->helpers->getDonations($user);
               $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
                //dd($donations);
                $names = array();
                
                if($transactions->count() > 1)
               {
               	foreach($transactions as $d)
                   {
                   	$giver = User::where('id', $d->giver_id)->first();
                        $receiver = User::where('id', $d->receiver_id)->first();
                        if(!isset($names[$giver->id])) $names[$giver->id] = $giver->first_name." ".$giver->last_name;
                        if(!isset($names[$receiver->id])) $names[$receiver->id] = $receiver->first_name." ".$receiver->last_name;
                   }
               }
                
                return view('transactions', compact(['user','transactions','names','sidebarUpdates']));
           }
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    /**
	 * Shows the user Referrals.
	 *
	 * @return Response
	 */
    public function getReferrals()
    {
        if(Auth::check())
       {
       	$user = Auth::user();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {
           	$referrals = $this->helpers->getReferrals($user);
                #dd($referrals);
                $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
                
                return view('referrals', compact(['user','referrals','sidebarUpdates']));
           }
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    /**
	 * Shows the user Profile.
	 *
	 * @return Response
	 */
    public function getProfile()
    {
        if(Auth::check())
       {
       	$user = Auth::user();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {
           	$bank = BankDetails::where('user_id',$user->id)->first();
                #dd($bank);
                $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
                
                return view('profile', compact(['user','bank','sidebarUpdates']));
           }
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    /**
	 * Updates the user Profile.
	 *
	 * @return Response
	 */
    public function postProfile(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {
           	$bank = BankDetails::where('user_id',$user->id)->first();
                #dd($bank);
                
                $validator = Validator::make($req, [
                             'email' => 'required|email',
                             'fname' => 'required',
                             'lname' => 'required',
                         #    'phone' => 'required',
                             'bname' => 'required',
                             'acname' => 'required',
                            # 'acno' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$user->update(['first_name' => $req['fname'],'last_name' => $req['lname'],'email' => $req['email']]);
                     $bank->update(['bank_name' => $req['bname'],'acc_name' => $req['acname']]);
                     
                     Session::flash("update-profile-status", "success");
                     return redirect()->intended('profile');            
                 }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    
    /**
	 * Shows the Support page.
	 *
	 * @return Response
	 */
    public function getSupport()
    {
        if(Auth::check())
       {
       	$user = Auth::user();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {     
               $tickets = $this->helpers->getTickets($user);
               #dd($tickets);
               $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
               return view('support', compact(['user','tickets','sidebarUpdates']));
           }
                      
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    /**
	 * Shows the Support page.
	 *
	 * @return Response
	 */
    public function getCreateTicket()
    {
        if(Auth::check())
       {
       	$user = Auth::user();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           { 
                $sidebarUpdates = $this->helpers->getSidebarUpdates($user);   
                $name = $user->first_name." ".$user->last_name;
                $email = $user->email;
                return view('create_ticket', compact(['user','sidebarUpdates','name','email']));
           }
                      
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
  

/**
	 * Shows the News page.
	 *
	 * @return Response
	 */
    public function getNews($id="")
    {
        if(Auth::check())
       {
       	$user = Auth::user();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {  
           	if($id == "") $ret = $this->helpers->getNews("all");
                else $ret = $this->helpers->getNews($id);
                $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
                return view('news', compact(['user','ret','sidebarUpdates']));
           }
                      
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
      
    
   /**
	 *Creates a new Ticket.
	 *
	 * @return Response
	 */
    public function postCreateTicket(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     
                $validator = Validator::make($req, [
                             'subject' => 'required',
                             'message' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$ticket_id = $this->helpers->createTicketID($user);
                     
                     #dd($ticket_id);
                     $ticket = Tickets::create(['user_id' => $user->id, 'ticket_id' => $ticket_id, 'status' => 'pending', 'subject' => $req['subject'],'message' => $req['message']]);
                     Session::flash("create-ticket-status", "success");
                     return redirect()->intended('support');            
                 }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    public function initPackages()
   {
   	Packages::create(['name' => "basic", "price" => "10000", "enabled" => "yes"]);
       Packages::create(['name' => "starter", "price" => "20000", "enabled" => "yes"]);
       Packages::create(['name' => "premium", "price" => "50000", "enabled" => "yes"]);
       Packages::create(['name' => "pro", "price" => "100000", "enabled" => "no"]);
       Packages::create(['name' => "ultimate", "price" => "200000", "enabled" => "no"]);
       Packages::create(['name' => "king", "price" => "500000", "enabled" => "no"]);
       
       return redirect()->intended('/');    
   }
   
   
   public function getTest()
  {
  //	$this->helpers->getGHPriorityNumber();
     $u = User::where('id', '3')->first();
     $p = User::where('id', '6')->first();
     
  //   $this->helpers->bounceUser($u,"20000");
     $this->helpers->setNextReceiver("20000");
     $this->helpers->merge($u, "20000");
      return redirect()->intended('/');    
  }
  
  
   /**
	 *Marks a donation as paid.
	 *
	 * @return Response
	 */
    public function postMarkPaid(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     
                  #dd($req);
               $validator = Validator::make($req, [
                             'payment-type' => 'required',
                             'price' => 'required',
                              'grepo' => 'required',
                             'slip-name' => 'required',
                             'payment-image' => 'required|image'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$receiver = User::where('id', $req['grepo'])->first();
                     $d  = Pool::where('receiver_id', $req['grepo'])->where('giver_id', $user->id)->where('amount', $req['price'])->where('status', 'pending')->first();
                                        
 
                     if($receiver != null && $d != null)
                     {
                         if($request->hasFile('payment-image') && $request->file('payment-image')->isValid())
                        {
 	                      $file = $request->file('payment-image');
                           $ext = $file->getClientOriginalExtension();     
                           $dst = date("y_m_d")."_".$d->id."_".$user->id."_".$receiver->id;            
	
                          $destination = public_path("pop/").$dst;
                          $file->move($destination);
                        } 

                        $data = array('donation_id' => $d->id, "slip_name" => $req['slip-name'], 
                                                                                                "payment_name" => $user->first_name." ".$user->last_name,
                                                                                               "payment_image" => $dst,  "payment_type" => $req['payment-type']);
                                                                                               
                      $this->helpers->CreatePaymentInformation ($data);                                                                    
                       $d->status = "pending_confirmation"; $d->save();
                     	Session::flash("mark-paid-status", "success");
                         return "User has been marked as PAID.";      
                     }                     
                        
                 }                   
           }
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }  
    
    
   /**
	 *Confirms payment for donation and converts giver to either gh, gh-50 or gh-100
	 *
	 * @return Response
	 */
    public function postConfirmPay(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     
                $validator = Validator::make($req, [
                             'grepo' => 'required',
                             'price' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$giver = User::where('id', $req['grepo'])->first();
                     $d  = Pool::where('giver_id', $req['grepo'])->where('receiver_id', $user->id)->where('amount', $req['price'])->where('status', 'pending_confirmation')->first();
 
                     if($giver != null && $d != null)
                     {
                         $this->helpers->confirm($d, $giver);                                                                                
                         #dd($d);
                     	Session::flash("confirm-pay-status", "success");
                         return redirect()->intended('dashboard');      
                     }               
                 }           
           }
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }  


   /**
	 *Marks a donation as fake and disable the giver.
	 *
	 * @return Response
	 */
    public function postReportDonation(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all(); #dd($req);

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     
                $validator = Validator::make($req, [
                             'grepo' => 'required',
                             'price' => 'required'                             
                   ]);
         
                 if($validator->fails())
                  {
                       $messages = $validator->messages();
                      //dd($messages);
             
                      return redirect()->back()->withInput()->with('errors',$messages);
                 }
                
                 else
                 {
                 	$giver = User::where('id', $req['grepo'])->first();
                     $d  = Pool::where('giver_id', $req['grepo'])->where('receiver_id', $user->id)->where('amount', $req['price'])->where('status', 'pending_confirmation')->first();
 
                     if($giver != null && $d != null)
                     {
                        $this->helpers->report($d, $giver);                                                                                
                    
                     	Session::flash("report-donation-status", "success");
                         return redirect()->intended('dashboard');      
                     }                         
                }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      
    
    
/**
	 *User cannot pay.
	 *
	 * @return Response
	 */
    public function postCannotPay(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
           $req = $request->all();

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     

                if($user == null){}
                 else
                 {
                 	$validator = Validator::make($req, [
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
                 	#dd($user);
                 	$giver = $user;                    
                     $as = AccountStatus::where('user_id', $user->id)->first();
                     $as->awaiting_pay = "cannotpay"; $as->save();
                     $p = Packages::where('id', $as->package_id)->first();
                     $d  = Pool::where('giver_id', $user->id)->where('receiver_id', $req['grepo'])->where('status', 'pending')->first();
 
                     if($giver != null && $d != null)
                     {
                        $this->helpers->cannotpay($d, $giver);                                                                                
                    
                     	Session::flash("cannotpay-status", "success");
                         return redirect()->intended('dashboard');      
                     }       
                  }                  
                }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }          

/**
	 *User recycles another package.
	 *
	 * @return Response
	 */
    public function getRecycle($package)
    {
        if(Auth::check())
       {
       	$user = Auth::user();           

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     

                if($user == null){}
                 else
                 {
                 	$pkg = Packages::where('id',$package)->first();
                 	#dd($pkg);
                 
                     if($pkg == null){}
                     
                     else{
                     	$as = AccountStatus::where('user_id', $user->id)->first();
                          $pp = PoolPosition::where('user_id', $user->id)->first();
                     	//set user awaiting_pay to no
                     	$as->awaiting_pay = "no";
                          $as->merged = "no";
                                                                                       
                         //set user package to pkg
                          $as->package_id = $pkg->id;
                          $pp->package = $pkg->id;
                          
                          $as->save();  $pp->save();
                          
                          //set user status to ph
                         $this->helpers->setUserStatus($user,"PH");
                         
                     
                         
                         return redirect()->intended('dashboard');
                     }             	                        
                }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }          


/**
	 *User countdown expires and gets blocked.
	 *
	 * @return Response
	 */
    public function getBlock()
    {
        if(Auth::check())
       {
       	$user = Auth::user();           

           if($user->role == "superadmin"){ return redirect()->intended('admin-101'); }
           
           else
           {                     

                if($user == null){}
                 else
                 {
                 	$d  = Pool::where('giver_id', $user->id)->where('status', 'pending')->first();
 
                     if($d != null)
                     {
                        $this->helpers->block($d);                                                                                
                    
                     	Session::flash("block-status", "success");
                         return redirect()->intended('logout');      
                     }                                      	                        
                }
           }           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }          


public function getCountdownTest()
{
	$now = Carbon::now();
	$deadline = $now->addHours(2);
	#dd($deadline);
	$ds = "hour:".$deadline->hour.", minute: ".$deadline->minute;
	$ns = "hour:".$now->hour.", minute: ".$now->minute;
	echo $ns."<br>";
	echo $ds."<br>";
}

public function getPractice()
{
	/*$u = User::where('id',"40")->first();
	$this->helpers->setUserStatus($u,"PH");
	
	$u = User::where('id',"39")->first();
	$this->helpers->setUserStatus($u,"PH");
	
	$u = User::where('id',"51")->first();
	$this->helpers->setUserStatus($u,"PH");
	
	$u = User::where('id',"1")->first();
	$u->update(['username' =>"admin"]);
	
	$p = Pins::where('number', "13c7e2565c61")->first();
	$p->update(['pin_count' =>"1"]);
	
	for($i=0; $i < 400; $i++)
    {
    	#$p = $this->helpers->generateActivationPin();
        #Pins::create(["number" => $p, "used_by" => "", "pin_count" => "5", "valid" => "yes"]);
               
    } 
    
    
    $pins = Pins::where('used_by',"")->get();
    $this->helpers->sendEmail("kudayisitobi@gmail.com",'Activation pins',['pins' => $pins],'emails.pins','view');
	*/
	
	$users = [4,13,27,38,39,40,51];
	
	#foreach($users as $u){
		$user = User::where('id', "81")->first();
		$this->helpers->deleteUser($user);
   # } 
    return redirect()->intended('/');
}



}