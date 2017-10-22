<?php
namespace App\Helpers;

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
use App\Countdown; 
use App\Notifications; 
use App\Pins;
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth; 
use App\MessageBird\Client;
use App\MessageBird\Objects\Message;
use App\MessageBird\Exceptions;

class Helper implements HelperContract
{
    function createUser($data)
    {
    	return User::create(['first_name' => $data["fname"],
                                           'last_name' => $data["lname"],
                                           'phone' => $data["phone"],
                                           'email' => $data["email"],
                                           'online' => "no",
                                           'password' => bcrypt($data["pass"]),
                                           'username' => $data["username"],
                                         ]);
    }
    
    function createUserStep0($data)
    {
    	return User::create(['first_name' => $data["fname"],
                                           'last_name' => $data["lname"],
                                           'email' => $data["email"],
                                           'online' => "no"
                                         ]);
    }
    
    
    function createBankDetails($data)
    {
    	return BankDetails::create(['user_id' => $data["user_id"],
                                           'bank_name' => $data["bname"],
                                           'acc_name' => $data["acname"],
                                           'acc_num' => $data["acno"],
                                         ]);
    }
    
    
        function createReferrals($data)
    {
    	return Referrals::create(['user_id' => $data["user_id"],
                                           'referral_id' => $data["referral_id"],
                                         ]);
    }
    
    
        function createAccountStatus($data)
    {
    	return AccountStatus::create(['user_id' => $data["user_id"],
                                           'package_id' => $data["package"],
                                           'status' => "PH",
                                           'verified' => "no",
                                           'enabled' => "yes",
                                            'merged' => "no",
                                         ]);
    }
    
    
    function createPackages($data)
    {
    	return Packages::create(['name' => $data["name"],
                                           'price' => $data["price"],
                                           'enabled' => $data["enabled"],
                                         ]);
    }
    
    function createDonation($data)
    {
         //$data["transaction_id"] = 0;
    	return Donations::create(['transaction_id' => $data["transaction_id"],
                                           'giver_id' => $data["giver_id"],
                                           'receiver_id' => $data["receiver_id"],
                                           'amount' => $data["amount"],
                                            'valid' => $data["valid"],
                                            'status' => $data["status"],
                                         ]);
    }
    
    
    
    function createTicket($data)
    {
         $data["ticket_id"] = 0;
    	return Tickets::create(['ticket_id' => $data["ticket_id"],
                                           'user_id' => $data["user_id"],
                                           'subject' => $data["subject"],
                                           'message' => $data["message"],
                                            'status' => $data["status"],
                                         ]);
    }
    
    
    function createNews($data)
    {
    	return News::create(['message' => $data["message"],
                                           'current' => $data["current"],                                      
                                         ]);
    }
    
    
        function createSiteMessages($data)
    {
    	return SiteMessages::create(['message' => $data["message"],
                                           'in_use' => $data["in_use"],                                      
                                         ]);
    }
    
    
    function addToPool($data)
    {
    	return Pool::create(['giver_id' => $data["giver_id"],
                                           'receiver_id' => $data["receiver_id"],
                                           'amount' => $data["amount"],
                                           'status' => "pending"                                     
                                         ]);
    }
    
    
    function createPaymentInformation($data)
    {
    	return PaymentInformation::create(['donation_id' => $data["donation_id"],
                                           'payment_type' => $data["payment_type"],    
                                           'slip_name' => $data["slip_name"],
                                           'payment_image' => $data["payment_image"],                                  
                                         ]);
    }
    
    
    function createPoolPosition($data)
    {
    	return PoolPosition::create(['user_id' => $data["user_id"],
                                           'next' => $data["next"],    
                                           'package' => $data["package"],
                                            'amount' => $data["amount"],
                                           'remain' => $data["remain"],
                                           'priority' => $data["priority"],
                                           'ghcount' => 2
                                         ]);
    }
    
    
    function checkUsername($u)
    {
    	$model = User::where('username', $u)->get();
        $ret = ($model == null) ? "yes" : "no";
        return $ret;
    }
    
    
    //Return the next user to be paid from the queue
    function getNextOnQueue()
    {
    	//for now just return a user
      $ret = array();
       $u = User::where('username',"blackdiamond")->first();
       
       //we have the user, get the bank details
       $b = BankDetails::where('user_id',$u->id)->first();
       
       $ret['receiver-name'] = $u->first_name." ". $u->last_name; 
        $ret['bank-name'] = $b->bank_name; 
        $ret['acc-name'] = $b->acc_name; 
        $ret['acc-num'] = $b->acc_num; 
        $ret['phone'] = $u->phone; 
        $ret['alt-phone'] = ""; 
        $ret['email'] = ""; 
        
       return $ret;
    }
    
    
    function getDonations($user)
    {
    	$ret = array();
        $donations = Donations::whereRaw('receiver_id = ? or giver_id = ?', [$user->id, $user->id])->orderBy('created_at', 'desc')->get();
        
        return $donations;
        
    }
    
    function getReferrals($user)
    {
    	$ret = array();
        $refs = Referrals::where('user_id',$user->id)->first();
        #dd($refs);
        
        /*if($refs->count() > 0)
        {
        	foreach($refs as $r)
            {
            	
            }
            
        }*/
        
        return $refs;
        
    }
    
    function getTickets($user)
    {
    	$ret = array();
        $tickets = Tickets::where('user_id', $user->id)->get();
        
        return $tickets;
        
    }
    
    function getNews($id)
    {
    	$ret = array(); $news = null;
        $images = array("blog1.jpg","blog2.jpg","blog3.jpg");
        
        if($id == "all") $news = News::orderBy('created_at', 'desc')->get();
        else $news = News::where('news_id', $id)->get();
        
        if($news != null && $news->count() > 0)
        {
        	foreach($news as $n)
            {
            	$temp = array();
                $msg = explode("_#_",$n->message);
                $temp['id'] = $n->id;
                $temp['news-id'] = $n->news_id;
                $temp['current'] = $n->current;
                $temp['title'] = $msg[0];
                $temp['body'] = $msg[1];
                $temp['date'] = $n->created_at->format("jS F,Y h:i A");
                shuffle($images);
                $temp['news-image'] = asset("fundsforlife/images")."/".$images[0];
                
                array_push($ret, $temp);
            }
        }
        return $ret;
        
    }    
    
    
    function getSliderImages()
    {
    	$ret = array();
        $images = SliderImages::all();
        
        foreach($images as $i)
        {
        	$temp = array();                 
            
            if($i != null){   
            $temp['id'] = $i->id;
            $temp['uploaded_at'] = $i->created_at->format("jS F Y, h:i A");
            $temp['position'] = $i->position;

            $handle = null; $fn = null;

            if ($handle = opendir(public_path("slider/").$i->image)) {
               /* This is the correct way to loop over the directory. */
              while (false !== ($entry = readdir($handle))) {    $fn = $entry;          }
           }
           closedir($handle);
           
            $temp['image'] = $i->image."/".$fn; #dd($i);
            
            array_push($ret, $temp);
            }

        }
        return $ret;
        
    }
    
    
    function createTicketID($user)
    {
    	$ret = "454".date("sh").$user->id."1".date("s");
        return $ret;
    }
    
    
    
        //Return the next user to be paid by $user
    function getMergedReceiver($user)
    {
    	//get the donation model
      $ret = array();
       $d = Pool::where('giver_id',$user->id)->first();
       $uas = AccountStatus::where('user_id', $user->id)->first();
       $p = Packages::where('id', $uas->package_id)->first();
       
       if($d == null) return $ret;
       
       $u = User::where('id',$d->receiver_id)->first();
       
       //we have the user, get the bank details
       $b = BankDetails::where('user_id',$u->id)->first();
       
       $ret['user_id'] = $u->id;        
       $ret['receiver-name'] = $u->first_name." ". $u->last_name; 
       $ret['receiver_id'] = $d->receiver_id; 
        $ret['bank-name'] = $b->bank_name; 
        $ret['acc-name'] = $b->acc_name; 
        $ret['acc-num'] = $b->acc_num; 
        $ret['phone'] = $u->phone; 
        $ret['alt-phone'] = ""; 
        $ret['email'] = $u->email;
        $ret['amount'] = $d->amount;
         $ret['status'] = $d->status;   
         $dl = Carbon::parse($d->created_at); $dl = $dl->addHours(6);
         $ret['deadline'] = $dl->format("jS F Y, h:i A");   
        
       return $ret;
    }
    
    
    //Return the next users to pay $user
    function getMergedGivers($user)
    {
    	//get the donation model
      $ret = array();
       $donations = Pool::where('receiver_id',$user->id)->get();
       $uas = AccountStatus::where('user_id', $user->id)->first();
       $p = Packages::where('id', $uas->package_id)->first();
       
       if($donations == null) return $ret;
       
       foreach($donations as $d)
       {
       	$temp = array();
           $u = User::where('id',$d->giver_id)->first();

            //we have the user, get the bank details
           $b = BankDetails::where('user_id',$u->id)->first();
           $pi = PaymentInformation::where('donation_id', $d->id)->first();
            $temp['payment-type'] = null;
            $temp['slip-name'] = null;           
            $temp['payment-image'] = null;           
           
       
            $temp['user_id'] = $u->id; 
           $temp['giver-name'] = $u->first_name." ". $u->last_name; 
            $temp['bank-name'] = $b->bank_name; 
            $temp['acc-name'] = $b->acc_name; 
            $temp['acc-num'] = $b->acc_num; 
            $temp['phone'] = $u->phone; 
            $temp['alt-phone'] = ""; 
            $temp['email'] = $u->email;
            $temp['amount'] = $d->amount;
            $temp['status'] = $d->status;
            
            if($pi != null){          
            $temp['payment-type'] = $pi->payment_type;
            $temp['slip-name'] = $pi->slip_name;
            $handle = null; $fn = null;
            
            
            if(file_exists(public_path("pop/").$pi->payment_image)) 
             {
            if ($handle = opendir(public_path("pop/").$pi->payment_image)) {
               /* This is the correct way to loop over the directory. */
              while (false !== ($entry = readdir($handle))) {    $fn = $entry;          }
              $temp['payment-image'] = $pi->payment_image."/".$fn;
              closedir($handle);
           }
          } 
           else{
           	$temp['payment-image'] = "";
            } 
           
            
            }
            array_push($ret, $temp);
       }
       
   #  dd($ret);
        
       return $ret;
    }
    
    
    //Merges a user to another user for ph
    public function merge($user, $package)
   {
   	$status = "fail";
   	$uas = AccountStatus::where('user_id', $user->id)->first();      
       $p = Packages::where('id', $package)->first();
       
      if( ($uas->status == "PH" || $uas->status == "GH-O") && $uas->enabled == "yes" && $uas->activated == "yes")
      {
      	//get the next user to gh in the pool
         $this->setNextReceiver($package);
         $receiver_pos = PoolPosition::where('next','yes')->where('package', $package)->first();
                       #dd($receiver_pos);
                       
           if($receiver_pos != null)
           {
           	$receiver = User::where('id', $receiver_pos->user_id)->first();
               $ras = AccountStatus::where('user_id', $receiver->id)->first();
                    #dd($ras);
           if(($ras->status == "GH" || $ras->status == "GH-E"  || $ras->status == "GH-O") && $ras->merged == "no") 
          {
          	if($ras->status == "GH-O"){
          	  $receiver_pos->update(['priority' => '-1','next' => 'no']);
             } 
              else{
              	          	//get the amount based on giver account status
              $amount = $p->price;
              
             //Add record to pool
             $data = array("giver_id" => $user->id, "receiver_id" => $receiver->id, "amount" => $amount, "status" => "pending");
             $pool_entry = $this->addToPool($data);
          
             //Update both users merged to yes
             $uas->merged = "yes"; $uas->awaiting_pay = "yes"; $uas->save();          
             $ras->merged = "yes"; $ras->awaiting_pay = "yes"; $ras->save();  
             $status = "success";
           } 

          }    
          
        }   
      }
      
      return $status;
   }
   
function unmerge($d,$giver)
   {   
      
      //unmerge giver and disable
      $ras = AccountStatus::where('user_id', $d->receiver_id)->first();
      $gas = AccountStatus::where('user_id', $d->giver_id)->first();
       $gas->merged = "no"; 
       $gas->save();             
       
      $receiver_pos = PoolPosition::where('user_id', $d->receiver_id)->where('amount', $d->amount)->first();
      
      if($this->countMerges($d->receiver_id) > 1){}      
      else{     	
          $ras->merged = "no"; $ras->save();  
      }
      
  	$d->delete();
      
            	
   }   
   
  //bounce current eligible user
   public function bounceUser($user, $price)
   {
     //bounce the current eligible user
       $after = PoolPosition::where('next',"yes")->where('amount', $price)->first();	
       
       if($after != null)
      {
      	if($after->remain == "yes") $after->update(['next' => 'no', "remain" => "no"]);
          else if($after->remain == "no") $after->update(['next' => 'after_us', "remain" => "no"]);
      }
      
   }
 
   //Enables user for gh
    public function makeUserEligible($user, $package, $remain, $priority)
   {
       //set the current next user to no
       $receiver_pos = PoolPosition::where('next', 'yes')->where('package',$package)->first();       
       if($receiver_pos != null) $receiver_pos->update(['next' => 'no']);
   	
       //do the job
       $userpos = PoolPosition::where('user_id', $user-> id)->first();	  
       $p = Packages::where('id',$package)->first();

       if($userpos == null)
       {
            $data = array("user_id" => $user->id,"next" => "yes", "package" => $package, "amount" => 0, "remain" => $remain, "priority" => $priority);
            $this->CreatePoolPosition($data);  	
       } 

      else
      {
      	$userpos->update(["next" => "yes", "package" => $package, "amount " => 0, "remain" => $remain,"priority" => $priority]);
      }   
       
   }
   
   
    //sets user to ph or gh
    public function setUserStatus($user, $status, $data="")
   {
       //do the job
       $as = AccountStatus::where('user_id', $user->id)->first();	  
       $pos = PoolPosition::where('user_id', $user->id)->first();	  
       
      if($as != null)
      {
      	$as->update(["status" => $status]);
              
          if(is_array($data))
          {
          	$ret = [];
          
             switch($status)
             {
           	case "PH":
                 $ret = ['next' =>"no",'amount' =>"0",'priority' =>"-1",'remain' =>"no"];
               break;
               
               case "GH-O":
                 $ret = ['next' =>"no",'amount' =>"0",'remain' =>"no"];
               break;
               
               case "GH":
                 
               break;            
               
               case "GH-E":
                 $ret = ['amount' =>$data['amount'] ];
               break;
             } 
             
             if($ret != []) if($pos != null) $pos->update($ret);
          } 
      }   
       
   }
   
    //gets the next priority number
    public function getGHPriorityNumber()
   {
       //do the job
       $pool_positions = PoolPosition::where('priority', '!=', '0')->where('priority', '!=', '-1')->get();	  
       
       
       $ret = null;
       
      if($pool_positions->count() > 0)
      {
      	$temp = array();
          
          foreach($pool_positions as $p)
          {
          	array_push($temp, $p->priority);
          }
          
          $ret = max($temp) + 1;
          
      }   
       
       return $ret;
   }
   
   
       //sets the next user to receive payment
    public function setNextReceiver($package)
   {
       $pool_positions = PoolPosition::where('package',$package)->where('priority', '!=', '-1')->get();	  
             
       $ret = null;
       
      if($pool_positions->count() > 0)
      {
      	$temp = array(); $admin = false; $admin_pos = null; 
          $r = "";
          
          foreach($pool_positions as $p)
          {
          	$as = AccountStatus::where('user_id',$p->user_id)->first();
               
               if($as->status =="GH-O" || ( ($as->status =="GH" || $as->status =="GH-E") && $as->merged =="yes") ){} 
               else{
               if($p->priority == "0" && $p->next == "yes" && $p->package == $package )
              {
              	$admin = true;
                  $admin_pos = $p;
                  break;
              }
              else
              {
              	array_push($temp, $p->priority);         
              }        	
             } 
          }
          
          if($admin)
          {
          	$admin_acc = User::where('id', $admin_pos->user_id)->first();
               $this->makeUserEligible($admin_acc,$package, "no", $admin_pos->priority);               
          }
          
          else
          {
          	if(count($temp) < 1)
              {
              } 
              
              else
              {
                 $receiver_pos = PoolPosition::where('next', 'after_us')->where('package',$package)->first();
                              
               if($receiver_pos == null)
              {              
            	$ret = min($temp);
               //get the user with that priority and make eligible
               $receiver_pos = PoolPosition::where('priority', $ret)->first();
              }
                            
               $receiver = User::where('id', $receiver_pos->user_id)->first();
               $ras = AccountStatus::where('user_id', $receiver->id)->first();
              
               while($ras->status == "PH" || $ras->status == "GH-O" || $ras->status == "R" || $ras->status == "R2")
                {
                	$pp = ['next'=>'no'];
                    $pp['priority'] = "-1";
                	$receiver_pos->update($pp);
                	for($r=0; $r< count($temp); ++$r){
                	   if($temp[$r] == $ret) $temp = $this->copyArrayExcept($temp, $ret);
                    } 
                    
                    if(count($temp) > 0){
                    $ret = min($temp);
                    $receiver_pos = PoolPosition::where('priority', $ret)->where('package', $package)->first();
                    $receiver = User::where('id', $receiver_pos->user_id)->first();
                    $ras = AccountStatus::where('user_id', $receiver->id)->first();
                   } 
                }
                 #dd($temp);
              # dd($ras);
               $this->makeUserEligible($receiver,$package, "no", $receiver_pos->priority);
            }             
          }                                                               
      }   
   }
   
   public function copyArrayExcept($arr, $except)
   {
   	$temp = array();
       
       foreach($arr as $a){
           if($a != $except) array_push($temp, $a);          
       }
       
       return $temp;
   }
   
       //recycles user after successful GH or cancellation of PH
    public function recycle($user)
   {
       //get the user
       $u = User::where('id', $user)->first();	  
       
      if($u != null)
      {
      	#get pin count
           $as = AccountStatus::where('user_id', $u->id)->first();
           $pin = Pins::where('used_by',$u->id)->where('valid',"yes")->first();
           
           $npc = $pin->pin_count - 1;
           $pin->update(['pin_count' => $npc]);
           
           if($pin->pin_count < 1)
           {
           	$pin->update(['valid' => "no"]);
           	$this->r2($user);
           }
           
           else
           {    
          	$this->setUserStatus($u,"R");
          }
          
              //unmerge the user          
              $as->merged = "no"; $as->save();
          
          //set priority to -1 and ghcount to 0
          $pos = PoolPosition::where("user_id", $u->id)->first();
          if($pos != null) $pos->update(['priority' => '-1', 'package' => 0,'next' => 'no','amount' => 0]);
      }   
       
   }
   
   
          //disables user and requires activation pin
    public function r2($user)
   {
       //get the user
       $u = User::where('id', $user)->first();	  
       
      if($u != null)
      {
      	$this->setUserStatus($u,"R2");
      
          //unmerge the user
          $as = AccountStatus::where('user_id', $u->id)->first();
          $as->merged = "no"; $as->activated = "no"; $as->save();
          
          //set priority to -1 and ghcount to 0
          $pos = PoolPosition::where("user_id", $u->id)->first();
          if($pos != null) $pos->update(['priority' => '-1', 'package' => 0,'next' => 'no','amount' => 0]);
      }   
       
   }
   
   
   public function confirm($d, $giver)
   {
   	 $d->status = "confirmed"; $d->save();
        $ras = AccountStatus::where('user_id', $d->receiver_id)->first();
        $gas = AccountStatus::where('user_id', $d->giver_id)->first();
        $receiver = User::where('id', $d->receiver_id)->first();

        //create or update the givers pool position
       $gpos = PoolPosition::where('user_id', $giver->id)->first();
       $pn = $this->getGHPriorityNumber();	  

       if($gpos == null)
       {
            $data = array("user_id" => $giver->id,"next" => "no", "amount" => 0, "remain" => "no", "priority" => $pn, "package" => $ras->package_id);
            $gpos = $this->CreatePoolPosition($data);  	                    
       } 
       
       $rpos = PoolPosition::where('user_id', $receiver->id)->first();  
       $p = Packages::where('id', $rpos->package)->first();
       
       $amount = $d->amount;
       $newReceiverAmount = $rpos->amount + $amount;
       
       
       if($gas->status == "PH")
       {
       	$this->setUserStatus($giver, "GH");           
       } 
                                 
      else if($gas->status == "GH-O" ) 
      {
      	$this->setUserStatus($giver, "GH-E");
      }

      
      $gpos->update(["priority" => $pn,"remain" => "no", "amount" => 0]);
       
      #get pin count
           $pin = Pins::where('used_by',$receiver->id)->where('valid',"yes")->first();
           
           $npc = $pin->pin_count - 1;
           $pin->update(['pin_count' => $npc]);
           
           if($pin->pin_count < 1)
           {
           	$pin->update(['valid' => "no"]);
           	$this->r2($receiver->id);
           }
      else{		   
      if($ras->status == "GH")
      {
      	$status = "GH-O"; 
      	if($receiver->role == "special") $status = "GH-E"; 
      	$this->setUserStatus($receiver, $status);
      } 
      
      else if($ras->status == "GH-E" ) 
      {
      	$this->setUserStatus($receiver,"GH");
      } 
     
      }
      
      //unmerge giver
     
       $gas->merged = "no"; $gas->save();             
      
      //add thisnto donations and delete from pool
      $this->createDonation(array('transaction_id' => $d->id, 'giver_id' => $d->giver_id, 'receiver_id' => $d->receiver_id, "amount" => $d->amount, "valid" => "yes", "status" => $d->status) );
      
          if($this->countMerges($d->receiver_id) > 1){}
          else{
          	$ras->merged = "no"; $ras->save();  
          }
      
  	$d->delete();   

    //add notifications for admin   
    $a = User::where('id',0)->first();
    $this->setNotifications($a,"admin-news-ph","","",$giver,$receiver, $d->amount);
    $this->setNotifications($a,"admin-news-gh","","",$giver,$receiver, $d->amount);
   }
   
   function report($d,$giver)
   {
   	$d->status = "reported"; $d->save();
   
      
      //unmerge giver and disable
      $ras = AccountStatus::where('user_id', $d->receiver_id)->first();
      $gas = AccountStatus::where('user_id', $d->giver_id)->first();
       $gas->merged = "no"; 
        $gas->enabled = "no"; 
       $gas->save();             
      
      //add thisnto donations and delete from pool
      $this->createDonation(array('transaction_id' => $d->id, 'giver_id' => $d->giver_id, 'receiver_id' => $d->receiver_id, "amount" => $d->amount, "valid" => "no", "status" => $d->status) );
      
      $receiver_pos = PoolPosition::where('user_id', $d->receiver_id)->first();
       	
          if($this->countMerges($d->receiver_id) > 1){}
          else{
          	$ras->merged = "no"; $ras->save();  
          }
      
  	$d->delete();
      
            	
   }
   
function cannotpay($d,$giver)
   {
   	$d->status = "cancelled"; $d->save();
   
      
      //unmerge giver
      $ras = AccountStatus::where('user_id', $d->receiver_id)->first();
      $gas = AccountStatus::where('user_id', $d->giver_id)->first();
       $gas->merged = "no"; 
       $gas->save();       
          
      //recycle giver
     $this->recycle($d->giver_id);          
      
      //add thisnto donations and delete from pool
      $this->createDonation(array('transaction_id' => $d->id, 'giver_id' => $d->giver_id, 'receiver_id' => $d->receiver_id, "amount" => $d->amount, "valid" => "no", "status" => $d->status) );
      
      $receiver_pos = PoolPosition::where('user_id', $d->receiver_id)->first();
      
          if($this->countMerges($d->receiver_id) > 1){}
          else{
          	$ras->merged = "no"; $ras->save();  
          }   
      
  	$d->delete();
      
            	
   }   
    
    //gathers site statistics for display on the admin dashboard
    function getSiteStats()
    {
    	$ret = array();
    
        //total users
        $total_users = User::all(); //dd($total_users->count());
        $ret['total_users'] = $total_users->count(); 
        
        //total blocked users
        $total_blocked_users = AccountStatus::where('enabled','no')->get(); //dd($total_blocked_users->count());
        $ret['total_blocked_users'] = $total_blocked_users->count(); 
        
        //total blocked users
        $open_tickets = Tickets::where('status','pending')->get(); //dd($open_tickets->count());
        $ret['open_tickets'] = $open_tickets->count(); 
        
        //packages
        $packages = Packages::all(); //dd($packages->count());
        $ret['packages'] = $packages->count(); 
        
        //reported donations
        $reported_donations = Donations::where('valid','no'); //dd($reported_donations->count());
        $ret['reported_donations'] = $reported_donations->count(); 
        
        //active users now
        $active_users_now = User::where('online','yes'); //dd($active_users_now->count());
        $ret['active_users_now'] = $active_users_now->count(); 
        
        //active users today
        $temp = 0;
        foreach($total_users as $u)
        {
        	$lu = $u->updated_at->format("jS F,Y"); //dd($lu);
            if($lu == date("jS F,Y")) ++$temp;
        }
        $ret['active_users_today'] = $temp; 
        
        //awaiting payment
        $ap = 0; $am = 0;
        $awaiting_pay = Pool::where('status','pending')->get();
        
        if($awaiting_pay->count() > 0)
        {
            foreach($awaiting_pay as $a_p)
            {
                if($a_p->status == "pending")
                 {
                	$ap += 1;
                    $am +=  $a_p->amount;
                 }
            }            
       }  
       
      $ret['ap'] = $ap;  $ret['am'] = $am;            
      
        //completed payments
        $cp = 0; $cm = 0;
        $completed_pay = Donations::where('status','confirmed')->where('valid','yes')->get();
        
        if($completed_pay->count() > 0)
        {
            foreach($completed_pay as $c_p)
            {
                if($c_p->status == "confirmed")
                 {
                	$cp += 1;
                    $cm +=  $c_p->amount;
                 }
            }            
       }  
       
      $ret['cp'] = $cp;  $ret['cm'] = $cm;                
      
      //completed payments within the last 7 and 30 days
      $cp_7 = 0; $cm_7 = 0;
      $cp_30 = 0; $cm_30 = 0;
      
      $today = Carbon::now();
      
            foreach($completed_pay as $c_p)
            {
                if($c_p->status == "confirmed")
                 {
                   $up =  $c_p->created_at; //dd($today);
                   $diff = $up->diffInDays($today); //dd($diff);
                   
                   if($diff <= 7)
                   {
                   	$cp_7 += 1;
                       $cm_7 +=  $c_p->amount;
                   }   

                   if($diff <= 30)
                   {
                   	$cp_30 += 1;
                       $cm_30 +=  $c_p->amount;
                   }                                     
          
                 }
            }   
      $ret['cp_7'] = $cp_7;  $ret['cm_7'] = $cm_7;             
      $ret['cp_30'] = $cp_30;  $ret['cm_30'] = $cm_30;                
                      
       return $ret;
    }
    
    
    //gets stats about a user or all users
    function getUserStats($username)
    {
        $users = null; $ret = array();
        
    	if($username == "all") $users = User::where('role','!=','superadmin')->get();
        else $users = User::where('username', $username)->get();
        
        if($users != null || $users->count() > 0)
        {
        	foreach($users as $u)
            {
                $temp = array();
                               
            	$temp['name'] = $u->first_name." ".$u->last_name;
                $temp['email'] = $u->email;
                $temp['id'] = $u->id;
                $temp['username'] = $u->username;
                 $temp['role'] = $u->role;
                
                //bank details
                $b = BankDetails::where('user_id',$u->id)->first();
                if($b == null){
               $temp['bank_name'] = "yet to be filled";
                $temp['acc_name'] = "yet to be filled";
                 $temp['acc_num'] = "yet to be filled";
                } 
                else{
               $temp['bank_name'] = $b->bank_name;
                $temp['acc_name'] = $b->acc_name;
                 $temp['acc_num'] = $b->acc_num;
               } 
                //account status
                $as = AccountStatus::where('user_id',$u->id)->first();
                if($as == null){
                	$temp['status'] = "yet to be filled";
                  $temp['merged'] = "yet to be filled";
                  $temp['blocked'] = "yet to be filled";
                  $temp["package"] = "yet to be filled";
                } 
                else{
                 $temp['status'] = $as->status;
                  $temp['merged'] = $as->merged;
                  $temp['blocked'] = $as->enabled == "yes" ? "no" : "yes";
                  $temp["package"] = $as->package_id;
                 } 
                 
                 //pin count 
                $temp['pin'] = Pins::whereRaw("used_by = ? and valid =  'yes'",[$u->id])->first();
                #dd($temp);
                  array_push($ret,$temp);
            }
        }
        
        return $ret;
    }
    
    
    //gets stats about a donation or all Donations
    function adminGetDonations($username)
    {
        $donations = null; $ret = array();
        
    	if($username == "all") {$donations = Donations::orderBy('created_at', 'asc')->get();} 
        else
        {
        	$u = User::where('username',$username)->first();
             if($u != null) $donations = $this->getDonations($u);
        }
        
       // dd($donations);
        if($donations != null && $donations->count() > 0)
        {
        	foreach($donations as $d)
            {
                $temp = array();
                $g = User::where('id',$d->giver_id)->first();
                $r = User::where('id',$d->receiver_id)->first();
                               
            	$temp['giver'] = $g->username;
                $temp['receiver'] = $r->username;
                $temp['id'] = $d->transaction_id;
                $temp['amount'] = $d->amount;
                $temp['valid'] = $d->valid;
                $temp['status'] = $d->status;                
                $temp['date'] = $d->created_at->format("jS F,Y");
                  
                  array_push($ret,$temp);
            }
        }
        
        return $ret;
    }
    
    //gets stats about a ticket or all Tickets
    function adminGetTickets($username)
    {
        $tickets = null; $ret = array();
        
    	if($username == "all") {$tickets = Tickets::all();} 
        else
        {
        	$u = User::where('username',$username)->first();
             if($u != null) $tickets = $this->getTickets($u);
        }
        
       // dd($tickets);
        if($tickets != null && $tickets->count() > 0)
        {
        	foreach($tickets as $t)
            {
                $temp = array();
                $g = User::where('id',$t->user_id)->first();
                               
            	$temp['username'] = $g->username;
                $temp['id'] = $t->id;
                $temp['subject'] = $t->subject;
                $temp['message'] = $t->message;
                $temp['status'] = $t->status;                
                $temp['date'] = $t->created_at->format("jS F,Y");
                  
                  array_push($ret,$temp);
            }
        }
        
        return $ret;
    }    

    function getSiteMessages()
    {
    	$ret = array(); $sm = null;
        $sm = SiteMessages::all();
        
        if($sm != null && $sm->count() > 0)
        {
        	foreach($sm as $n)
            {
            	$temp = array();
                $temp['id'] = $n->id;
                $temp['message'] = $n->message;
                $temp['in_use'] = $n->in_use;
                $temp['date'] = $n->created_at->format("jS F,Y h:i A");
                
                array_push($ret, $temp);
            }
        }
        return $ret;
        
    }    
    
function getPackages()
    {
    	$ret = array(); $sm = null;
        $sm = Packages::all();
        
        if($sm != null && $sm->count() > 0)
        {
        	foreach($sm as $n)
            {
            	$temp = array();
                $temp['id'] = $n->id;
                $temp['name'] = $n->name;
                $temp['price'] = $n->price;
                $temp['enabled'] = $n->enabled;
                $temp['hype'] = $n->hype;
                $temp['date'] = $n->created_at->format("jS F,Y h:i A");
                
                array_push($ret, $temp);
            }
        }
        return $ret;
        
    }        


   function countMerges($user)
   {
       $ret = 0;
   	$user_merges = Pool::where('receiver_id',$user)->get();
       if($user_merges != null) $ret = $user_merges->count();
       
       return $ret;
   }  
   

          /**
           * Sends an email(blade view or text) to the recipient
           * @param String $to
           * @param String $subject
           * @param String $data
           * @param String $view
           * @param String $type (default = "view")
           **/
           function sendEmail($to,$subject,$data,$view,$type="view")
           {
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject){
                           $message->from('postmaster.richmama@gmail.com',"FundsForLife");
                           $message->to($to);
                           $message->subject($subject);
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject){
                           $message->from('postmaster.richmama@gmail.com',"FundsForLife");
                           $message->to($to);
                           $message->subject($subject);
                     });
                   }
           }
           
           
           
           function getCountdown($t1,$t2,$type){
               #echo "t1: ".$t1."<br>"."t2: ".$t2."<br>";
   
                  $arr1 = explode(":", $t1);
                  $arr2 = explode(":", $t2);
                  #print_r($arr1);
                  $ret = null;
   
                  if($arr2[4] == "00" && $arr1[4] != "00") $arr2[4] ="60";
   
   
                  if($type == "ph-deadline"){
                       if($arr1[3] == "11" || $arr1[3] == "23"){
                       	if($arr2[3] >= "13" || $arr2[3] >= "1"){$ret ="expired";} 
                           else $ret = array("d" => 0, "h" => 1, "m" => $arr2[4] - $arr1[4]);
                       }

                       elseif($arr1[3] == "12"){
                       	if($arr2[3] >= "14" || $arr2[3] >= "2"){$ret ="expired";} 
                           else $ret = array("d" => 0,"h" => 1, "m" => $arr2[4] - $arr1[4]);
                       } 
        
                       else{
                       	$ret = array("d" => 0,"h" => $arr2[3] - $arr1[3], "m" => $arr2[4] - $arr1[4]);
                           if($arr2[3] - $arr1[3] >= "2" && $arr2[4] - $arr1[4] >= "0") $ret ="expired";
                       }
        
                       if($arr2[2] - $arr1[2] > 0) $ret ="expired";
        
                       //fine-tune the result 
                       if(is_array($ret)){
                          $ret["h"] = 2 - $ret["h"];
                          if($ret["m"] < "0") $ret["m"] *="-1";
                        #  $ret["m"] = 60 - $ret["m"];
                       } 
                  } 
                  else if($type == "recycle-deadline"){$ret = array("d" => 0,"h" => 24, "m" => "1");} 
   

                  return $ret;
           }
           
           
           
           function getAuthenticatedUser()
           {
           	$user = null;
               if(Auth::check()) $user = Auth::user();
               return $user;
           }
           
           function setNotifications($user,$type,$title="",$message="",$giver="",$receiver="", $amount="")
           {
           	$notification = null; $n = [];
           
           	 if($n != null)
                 {
                 	$n = ['user_id' => "",'type' => "",'title' => "",'message' => "",'giver' => "",'receiver' => "",'amount' => ""];
                     $n['user_id'] = $user->id;
                     $n['type'] = $type;
                
                     
                     if($type == "news")
                         {                   	
                            $n['title'] = $title;
                            $n['message'] = $message;
                         }
                         
                    else if($type == "ph-deadline")
                         {                   	
                            
                         }
                         
                   else if($type == "recycle-deadline")
                         {                   	
                            
                         }
                         
                  else if($type == "admin-news-ph")
                         {                   	
                            $n['giver'] = $giver->id;
                            $n['receiver'] = $receiver->id;
                            $n['amount'] = $amount;
                         }
                         
                  else if($type == "admin-news-ph")
                         {                   	
                            $n['giver'] = $giver->id;
                            $n['receiver'] = $receiver->id;
                            $n['amount'] = $amount;
                         }
                         
                   $notification = Notifications::create($n);
                 }
                 
         	   return $notification;
           }
           
         function getNotifications($user)
           {
           	$ret = null;
           
               if($user != null)
               {
               	$ret = Notifications::where('user_id', $user->id)->get();
               }
               
               return $ret;
           }
                    
           
           function getUserUpdates($user)
           {
           	$ret = [];
               $notifications = $this->getNotifications($user);
               
               if($notifications != null)
               {
               	foreach($notifications as $n)
                    {
                    	$temp = []; 
                         $temp['type'] = $n->type;
                         $created_at = Carbon::parse($n->created_at);
                        $temp["time-received"] = $created_at->format("jS F,Y  h:i A");
                        
                    	if($temp['type'] == "news")
                         {                   	
                            $temp['title'] = $n->title;
                            $temp['message'] = $n->message;
                         }
                   
                        else if($temp['type']  == "ph-deadline")
                        {
                        	$temp['time-left'] =Carbon::now()->diffForHumans($created_at->addHours(2));                       	
                        }
                   
                   
                        else if($temp['type']  == "recycle-deadline")
                        {
                        	$temp['time-left'] = Carbon::now()->diffForHumans($created_at->addHours(24));
                        }
                      
                        else if($temp['type']  == "admin-news-ph")
                         {
                        	$g = User::where('id', $n->giver)->first();
                            $r = User::where('id', $n->receiver)->first();
                            $temp['giver'] = $g->username;
                            $temp['giver'] = $r->username;
                            $temp['amount'] = $n->amount;               
                        }
                   
                        else if($temp['type']  == "admin-news-ph")
                         {
                        	$g = User::where('id', $n->giver)->first();
                            $r = User::where('id', $n->receiver)->first();
                            $temp['giver'] = $g->username;
                            $temp['giver'] = $r->username;
                            $temp['amount'] = $n->amount;              
                         }
                         array_push($ret, $temp);
                    }
               }
               
               return $ret;
           }
           
           function getAdminUpdates()
           {
           	$ret = [];
               return $ret;
           }
           
           function getSidebarUpdates($user)
           {                 
                 $ret = ['updates' => null, 'updates_count' => 0, 'donations' => null, 'donations_count' => 0, 'availablePackages' => null];            
             
             if($user != null)
               {
                 $ret['updates'] = $this->getUserUpdates($user);
                 $ret['updates_count'] = count($ret['updates']);
                 $ret['donations'] = $this->getDonations($user);
                 $ret['donations_count'] = count($ret['donations']);
                 $ret['availablePackages'] = $this->getPackages();            
               }      

               return $ret;     	
           }
           
           
           function block($d)
           {
           	   	$d->status = "blocked"; $d->save();
   
      
      //unmerge giver and disable
      $ras = AccountStatus::where('user_id', $d->receiver_id)->first();
      $gas = AccountStatus::where('user_id', $d->giver_id)->first();
       $gas->merged = "no"; 
        $gas->enabled = "no"; 
       $gas->save();             
      
      //add thisnto donations and delete from pool
      $this->createDonation(array('transaction_id' => $d->id, 'giver_id' => $d->giver_id, 'receiver_id' => $d->receiver_id, "amount" => $d->amount, "valid" => "no", "status" => $d->status) );
      
      $receiver_pos = PoolPosition::where('user_id', $d->receiver_id)->first();
       	
          if($this->countMerges($d->receiver_id) > 1){}
          else{
          	$ras->merged = "no"; $ras->save();  
          }
      
  	$d->delete();
           }
           
           
       function getDashboardStats($user)
       {
       	$all_donations = $this->getDonations($user);
          #dd($all_donations);
          $ret = ["total_paid" => "0", "monthly_received" => "0", "cycles_completed" => "0"];
          $temp = 0; $temp2 = 0;
          foreach($all_donations as $d)
          {
          	//total paid
          	if($d->giver_id == $user->id)
              {
              	$temp += $d->amount;
              } 
              
              //monthly received
              if($d->receiver_id == $user->id){
                 $dd= $d->created_at->format("F Y");
                 if($dd == date("F Y"))
                 {
                 	$temp2 += $d->amount;
                 } 
             } 
          } 
          
          $ret["total_paid"] = $temp;
          $ret["monthly_received"] = $temp2;
          return $ret;
       } 
       
       function getRecentPaymentHistory($user)
       {
       	$all_donations = $this->getDonations($user);
          #dd($all_donations);
          $temp = [];       
          
          foreach($all_donations as $d)
          {
          	  $ret= ["amount" => "0", "giver" => "", "receiver" => "", "type" => "0", "date" => ""];
          	if($d->receiver_id == $user->id)
              {
              	$ret["giver"] = User::where('id', $d->giver_id)->first();
                  $ret["receiver"] = $user;
                   $ret["type"] = "received";
              } 
              else if($d->giver_id == $user->id)
              {
              	$ret["giver"] = $user;
                  $ret["receiver"] = User::where('id', $d->receiver_id)->first();
                  $ret["type"] = "disbursed";
              } 
              
               $ret["amount"] = $d->amount;
               $ret["status"] = $d->status;
               $ret["date"] = $d->created_at->format("D, jS F Y");
               
               array_push($temp, $ret);
          }          
         
         #dd($temp);
          return $temp;
       } 
       
       function sendOTP($number)
       {
       	$mb = new Client('Tg3Pitz74sxa0e2t1Avt3qhpy');
           #dd($mb);
           
           $MessageBird = new Client('Tg3Pitz74sxa0e2t1Avt3qhpy'); // Set your own API access key here.

$Message             = new Message();
$Message->originator = 'MessageBird';
$Message->recipients = array('+2349078416398');
$Message->body       = 'Your FundsForLife one-time verification code is ERQYB1';

try {
    $MessageResult = $MessageBird->messages->create($Message);
    return $MessageResult;

} catch (Exceptions\AuthenticateException $e) {
    // That means that your accessKey is unknown
    echo 'wrong login';

} catch (Exceptions\BalanceException $e) {
    // That means that you are out of credits, so do something about it.
    echo 'no balance';

} catch (Exception $e) {
    echo $e->getMessage();
}
       } 
   
   
   function generateActivationPin()
   {
   	$length = 6;
   	$ret = openssl_random_pseudo_bytes($length, $cstrong);
       $ret = bin2hex($ret);
       return $ret;
   }
   
   function useActivationPin($user,$pin)
   {
   	$pin->update(['used_by' => $user->id]);
       $as = AccountStatus::where('user_id',$user->id)->first();
       $as->update(['pin_id' => $pin->id, 'activated' => "yes"]);
       return "success";
   } 
   
   function getActivationPins()
   {
   	$pins = Pins::all();
       $ret = array();
       
       foreach($pins as $pin)
       {
       	$temp = array();
           $temp['id'] = $pin->id;
           $temp['number'] = $pin->number;
           $temp['used_by'] = "unused";
           if($pin->used_by != ""){
               $ub = User::where('id', $pin->used_by)->first();
               $as = AccountStatus::where('user_id',$ub->id)->first();
               $temp['used_by'] = $ub->username;
            } 
           $temp['pin_count'] = $pin->pin_count;
           $temp['valid'] = $pin->valid;
           $temp["date"] = $pin->created_at->format("D, jS F Y");
           array_push($ret,$temp);
       }
       
       return $ret;
       
   }
   
   function sendPhoneVerificationEmail($number)
   {
   	#Generate phone verification code
   	$length = 4;
   	$ret = openssl_random_pseudo_bytes($length, $cstrong);
       $ret = bin2hex($ret);
       
       #bind code to number
       $as = User::where("phone", $number)->first();
       $as->update(['vcode' => $ret]);
       
       #send code to email
       $title = $number." needs this verification code to signup";
        $this->sendEmail("kudayisitobi@gmail.com",$title,['code' => $ret, 'number' => $number],'emails.verify_phone','view');
   }
   
   function deleteUser($user)
   {
   	$pp = PoolPosition::where("user_id",$user->id)->first();
       $as = AccountStatus::where("user_id",$user->id)->first();
       $bd = BankDetails::where("user_id",$user->id)->first();
       
        $d = Pool::whereRaw('giver_id = ? or receiver_id = ?',[$user->id, $user->id])->first();
         if($d != null) $this->unmerge($d,$user);
         
         $bd->delete();
         $as->delete();
         $pp->delete();
         
         $user->delete();
       return "success";
   } 
   
}
?>