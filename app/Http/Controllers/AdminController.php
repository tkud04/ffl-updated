<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
use App\SliderImages; 
use App\Pool; 
use App\PoolPosition; 
use App\PaymentInformation;
use App\Notifications; 
use App\Pins;
use Validator; 
use Crypt; 
use Auth; 
use Session;
use Carbon\Carbon;
use File;

class AdminController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;
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
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret = $this->helpers->getSiteStats();
           	return view('admin_dashboard', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
    public function getTest()
   {
   	return bcrypt("account2");
   }
   
   
    /**
	 * Shows information on all users.
	 *
	 * @return Response
	 */
    public function getUsers()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret = $this->helpers->getUserStats("all");
               #dd($ret);
           	return view('admin_users', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }   
    
    
    /**
	 * Enables users.
	 *
	 * @return Response
	 */
    public function getEnable($user)
    {
        if(Auth::check())
       {
       	$u = Auth::user();
           
           if($u->role == "superadmin")
           {
               $ret = User::where("id",$user)->first();
               #dd($ret);
               if($ret != null){
               	$as = AccountStatus::where('user_id',$ret->id)->first();
                   $as->enabled = "yes"; $as->save();
                   Session::flash("enable-status","success");
               }
               else{Session::flash("enable-status","invalid");}
           	return redirect()->intended('admin/users');
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }       
    
    
    /**
	 * Disables users.
	 *
	 * @return Response
	 */
    public function getDisable($user)
    {
        if(Auth::check())
       {
       	$u = Auth::user();
           
           if($u->role == "superadmin")
           {
               $ret = User::where("id",$user)->first();
               #dd($ret);
               if($ret != null){
               	$as = AccountStatus::where('user_id',$ret->id)->first();
                   $as->enabled = "no"; $as->save();
                   Session::flash("disable-status","success");
               }
               else{Session::flash("disable-status","invalid");}
           	return redirect()->intended('admin/users');
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }         


    /**
	 * Shows information on all users.
	 *
	 * @return Response
	 */
    public function getFindUser()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
           	return view('admin_find_user', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }   
    
    
/**
	 * Shows information on all users.
	 *
	 * @return Response
	 */
    public function postFindUser(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all();
               
               $validator = Validator::make($req, [
                             'username' => 'required|min:5|exists:users'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
           	$ret = $this->helpers->getUserStats($req['username']);
                //dd($r);
               Session::flash("find-user-status","success");
               return view('admin_find_user', compact(['ret','user','sidebarUpdates']));
           }
           	
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }  


/**
	 * Shows information on making a user Eligible.
	 *
	 * @return Response
	 */
    public function getMakeEligible()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
           	return view('admin_make_eligible',compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }    
    
/**
	 * Redirect to making a user Eligible.
	 *
	 * @return Response
	 */
    public function getFindEligible()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
           	return redirect()->intended('admin/make-eligible');
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }        


/**
	 * Finds user to make Eligible.
	 *
	 * @return Response
	 */
    public function postFindEligible(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all();
               
               $validator = Validator::make($req, [
                             'username' => 'required|min:5|exists:users'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
           	$ret = $this->helpers->getUserStats($req['username']);
               $packages = Packages::where("enabled","yes")->get();
                //dd($r);
               Session::flash("find-user-status","success");
               Session::flash("grepo",$ret[0]["id"]);
               return view('admin_make_eligible', compact(['ret','packages','user','sidebarUpdates']));
           }
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      


/**
	 * Handles making a user Eligible.
	 *
	 * @return Response
	 */
    public function postMakeEligible(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all();
              // dd($req);
               
               $validator = Validator::make($req, [
                             'grepo' => 'required',
                             'fq' => 'required|accepted',
                             'mu' => 'required|accepted',
                             'plan' => 'required',
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
              # dd($req);
               
               //get the user
               $u= User::where('id',$req['grepo'])->first();
               $as = AccountStatus::where('user_id', $u-> id)->first();
               
               if($u != null && $as != null)
              {
                  //get the package
                  $p = Packages::where('id', $req['plan'])->first();
                  $as->package_id = $p->id; $as->save();
                  
                  //set to gh
                  $this->helpers->setUserStatus($u,"GH");
                  
                  //add to the front of queue
                  $remain = "no";
                  if(isset($req['rfq']) && $req['rfq'] == "on") $remain = "yes";
                  $this->helpers->makeUserEligible($u, $p->id, $remain, "0");
                  
              	Session::flash("make-eligible-status","success");
              }
              
              else Session::flash("make-eligible-status","error");
               
               return redirect()->intended('admin/make-eligible');
           }
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }            
      
      
    /**
	 * Shows information on all Donations.
	 *
	 * @return Response
	 */
    public function getDonations()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $donations = $this->helpers->adminGetDonations("all");
              #dd($donations );               
           	return view('admin_donations', compact(['donations','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }                    
        
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }         
    
    /**
	 * Shows information on all Donations.
	 *
	 * @return Response
	 */
    public function getFindDonation()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	return view('admin_find_donation', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }             
    
    
/**
	 * Finds a donation.
	 *
	 * @return Response
	 */
    public function postFindDonation(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all();
               
               $validator = Validator::make($req, [
                             'username' => 'required|min:5|exists:users'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
           	$ret = $this->helpers->adminGetDonations($req['username']);
                //dd($r);
               Session::flash("find-donation-status","success");
               return view('admin_find_donation', compact(['ret','user','sidebarUpdates']));
           }
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }          
    
/**
	 * Shows information on all Packages.
	 *
	 * @return Response
	 */
    public function getPackages()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret = $this->helpers->getPackages();
              # dd($ret);               
           	return view('admin_packages', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }   


/**
	 * Shows information on all Packages.
	 *
	 * @return Response
	 */
    public function getEnablePackage($id)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $p = Packages::where("id", $id)->first();
               if($p != null)
               {
               	$p->update(['enabled' => "yes"]);
                    Session::flash("enable-status","success");
               }
              # dd($ret);               
           	return redirect()->intended('admin/packages');
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }    


/**
	 * Shows information on all Packages.
	 *
	 * @return Response
	 */
    public function getDisablePackage($id)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $p = Packages::where("id", $id)->first();
               if($p != null)
               {
               	$p->update(['enabled' => "no"]);
                    Session::flash("disable-status","success");
               }
              # dd($ret);               
           	return redirect()->intended('admin/packages');
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      
        
    
    
    /**
	 * Shows information on all Tickets.
	 *
	 * @return Response
	 */
    public function getTickets()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret = $this->helpers->adminGetTickets("all");
              # dd($ret);               
           	return view('admin_tickets', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }         
    
    /**
	 * Shows information on all Tickets.
	 *
	 * @return Response
	 */
    public function getFindTicket()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	return view('admin_find_ticket', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }             
    
    
/**
	 * Finds a donation.
	 *
	 * @return Response
	 */
    public function postFindTicket(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all(); 
               
               $validator = Validator::make($req, [
                             'username' => 'required|min:5|exists:users'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
           	$ret = $this->helpers->adminGetTickets($req['username']);
                //dd($ret);
               Session::flash("find-ticket-status","success");
               return view('admin_find_ticket', compact(['ret','user','sidebarUpdates']));
           }
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }              
    
    
/**
	 * Finds a donation.
	 *
	 * @return Response
	 */
    public function getRespondToTicket($grepo)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
           	$ret = Tickets::where('id',$grepo)->first();
                //dd($r);
                $ret->update(['status' => "solved"]);
               Session::flash("solve-ticket-status","success");
               return redirect()->intended('admin/tickets');
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }                  

    /**
	 * Shows information on all News.
	 *
	 * @return Response
	 */
    public function getNews()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret = $this->helpers->getNews("all");
             # dd($ret);               
           	return view('admin_news', compact(['ret', 'user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }


    /**
	 * Shows form to add  News.
	 *
	 * @return Response
	 */
    public function getAddNews()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	return view('admin_add_news', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }         


/**
	 * Adds a news item.
	 *
	 * @return Response
	 */
    public function postAddNews(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all(); 
               
               $validator = Validator::make($req, [
                             'title' => 'required|min:5',
                             'body' => 'required'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
           	$req['message'] = $req['title']."_#_".$req['body'];
               $req['current'] = "no";
               $this->helpers->createNews($req);
                //dd($ret);
               Session::flash("add-news-status","success");
               return redirect()->intended('admin/news');
           }
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }              


/**
	 * Finds a donation.
	 *
	 * @return Response
	 */
    public function getMarkNewsCurrent($grepo)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {                              
           	$fmr = News::where('current',"yes")->first();
               if($fmr != null) $fmr->update(['current' => "no"]);
               $ret = News::where('id',$grepo)->first();
                //dd($r);
                $ret->update(['current' => "yes"]);
               Session::flash("mark-news-status","success");
               return redirect()->intended('admin/news');
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }           

    /**
	 * Shows the site settings.
	 *
	 * @return Response
	 */
    public function getSiteSettings()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret =  $this->helpers->getSiteMessages();
           	return view('admin_site_settings', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }


    /**
	 * Shows form to add  News.
	 *
	 * @return Response
	 */
    public function getAddSiteMessage()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	return view('admin_add_site_message', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }
    
    
/**
	 * Finds a donation.
	 *
	 * @return Response
	 */
    public function getMerge($user)
    {
        if(Auth::check())
       {
       	$u = Auth::user();
           
           if($u->role == "superadmin")
           {               
              $uas = AccountStatus::where('user_id', $user)->first();
               $p = Packages::where('id', $uas->package_id)->first();
               $giver = User::where('id', $user)->first();
              $this->helpers->merge($giver,$p->id);
               Session::flash("merge-status","success");
               return redirect()->intended('admin/users');
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      


/**
	 * Finds a donation.
	 *
	 * @return Response
	 */
    public function getUnmerge($user)
    {
        if(Auth::check())
       {
       	$u = Auth::user();
           
           if($u->role == "superadmin")
           {               
              $pos= PoolPosition::where('user_id', $user)->first();
               $d = Pool::whereRaw('giver_id = ? or receiver_id = ?',[$user, $user])->first();
              $x = [$pos, $d]; #dd($x);
              $this->helpers->unmerge($d,$user);
               Session::flash("unmerge-status","success");
               return redirect()->intended('admin/users');
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }     


/**
	 * Shows the site Slider Images.
	 *
	 * @return Response
	 */
    public function getSliderImages()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
               $ret =  $this->helpers->getSliderImages();
           	return view('admin_slider_settings', compact(['ret','user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }


    /**
	 * Shows form to add Slider image.
	 *
	 * @return Response
	 */
    public function getAddSliderImage()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	return view('admin_add_slider_image', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      


/**
	 * Uploads a new slider image.
	 *
	 * @return Response
	 */
    public function postAddSliderImage(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all(); $ret = null;
               
               $validator = Validator::make($req, [
                             'slider-image' => 'required|image'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             //return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
             
             $ret = "<div class='alert alert-danger'><strong>Whoops!</strong> There were some problems uploading the image.<br><br>";
             $ret .= "<ul>";
					
             foreach($messages->all() as $error) $ret .= "<li>".$error."</li>";
            
             $ret .= "</ul></div>";
           }
           
           else
           {
           	if($request->hasFile('slider-image') && $request->file('slider-image')->isValid())
                        {
                        	$si = SliderImages::create(['image'=> "",'position'=> "random"]);
                        
 	                      $file = $request->file('slider-image');
                           $ext = $file->getClientOriginalExtension();     
                           $dst = date("y_m_d")."_slider_".$si->id;            
	
                          $destination = public_path("slider/").$dst;
                          $file->move($destination);                          
                          $si->image = $dst; $si->save();                         
                          
                          $ret ="Slider Image has been UPLOADED.";
                        } 
           }
           
           return $ret;
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }        


/**
	 * Shows form to set Slider image.
	 *
	 * @return Response
	 */
    public function getSetSliderImage($pos, $id)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	//dd($pos);
           
             $simg = SliderImages::where('id', $id)->first();
             
             if($simg != null){
           
               switch($pos)
               {
               	case "first":
                     $first = SliderImages::where('position','first')->first();
                     if($first != null){ $first->position = "random"; $first->save();}
                     
                     $simg->position = "first"; $simg->save();
                     Session::flash("slider-settings-status","success");
                   break;
                   
                   case "none":
                     $simg->position = "random"; $simg->save();
                     Session::flash("slider-settings-status","success");
                   break;
                   
                   case "delete":                              
                     $temp = "public/slider/".$simg->image;
                    if(File::exists($temp)) File::deleteDirectory($temp);
                     
                    if(!File::exists($temp)) $simg->delete();
                     
                     Session::flash("delete-slider-status","success");
                   break;
                   
                   default:
                     Session::flash("slider-settings-status","unknown");
               }
               
             }
             return redirect()->intended('admin/slider-settings');
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }   


/**
	 * Shows form to set Slider image.
	 *
	 * @return Response
	 */
    public function getLegalSettings()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {           
             #dd($user);
             return view('admin_legal_settings', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }         
    
    /**
	 * Shows form to set Slider image.
	 *
	 * @return Response
	 */
    public function getEditLegalInformation()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {           
             #dd($user);
             return view('admin_edit_legal_information', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }         
    
    
     /**
	 * Shows Activation Pins table
	 *
	 * @return Response
	 */
    public function getActivationPins()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	$pins = $this->helpers->getActivationPins();
           	return view('admin_pins', compact(['user','sidebarUpdates','pins']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      
    
    /**
	 * Shows Generate Activation Pin form
	 *
	 * @return Response
	 */
    public function getGenerateActivationPin()
    {
        if(Auth::check())
       {
       	$user = Auth::user();
$sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {
           	return view('admin_generate_pin', compact(['user','sidebarUpdates']));
           }
           
           else{ return redirect()->intended('login'); }           
           
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }      
    
    
    /**
	 * Handles generating activation pin
	 *
	 * @return Response
	 */
    public function postGenerateActivationPin(Request $request)
    {
        if(Auth::check())
       {
       	$user = Auth::user();
          $sidebarUpdates = $this->helpers->getSidebarUpdates($user);
           
           if($user->role == "superadmin")
           {               
               $req = $request->all(); $ret = null;
             #  dd($req);
               
               $validator = Validator::make($req, [
                             'pc' => 'required|not_in:none'
               ]);    
           
            if($validator->fails())
           {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
           }
           
           else
           {
           	$n = $this->helpers->generateActivationPin();
               $p = Pins::create(['number' => $n, 'valid' => "yes", 'used_by' => "", "pin_count" => 5]);
               Session::flash("generate-pin-status", "success");
               Session::flash("pin",$p->number);
               return redirect()->intended('admin/generate-activation-pin');
           }
           
           }
           
           else{ return redirect()->intended('login'); }                     
           
       }
        
        else
        {
        	return redirect()->intended('login');
        }
    }        
                           
    
 } #End brace