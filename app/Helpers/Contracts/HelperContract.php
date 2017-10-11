<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function createUser($data);
        public function createUserStep0($data);
        public function createBankDetails($data);
        public function createReferrals($data);
        public function createAccountStatus($data);
        public function createPackages($data);
        public function createDonation($data);
        public function createTicket($data);
        public function createNews($data);
        public function createSiteMessages($data);
        public function addToPool($data);
        public function createPoolPosition($data);
        public function createPaymentInformation($data);
        public function checkUsername($u);
        public function getNextOnQueue();
        public function getDonations($user);
        public function getSliderImages();
        public function getTickets($user);
        public function getNews($id);
        public function getReferrals($user);
        public function createTicketID($user);
        public function getMergedReceiver($user);
        public function getMergedGivers($user);
        public function merge($user,$package);
        public function unmerge($d,$giver);
        public function bounceUser($user, $price);
        public function makeUserEligible($user, $package, $remain, $priority);
        public function setUserStatus($user, $status, $data);
        public function getGHPriorityNumber();
        public function setNextReceiver($package);
        public function copyArrayExcept($arr, $except);
        public function recycle($user);
        public function confirm($d, $giver);
        public function report($d, $giver);
        public function getSiteStats();
        public function getUserStats($username);
        public function adminGetDonations($username);
        public function getSiteMessages();
        public function getPackages();
        public function countMerges($user);
        public function sendEmail($to,$subject,$data,$view,$type);
        public function getCountdown($t1,$t2,$type);
        public function getAuthenticatedUser();
        public function getNotifications($user);
        public function setNotifications($user,$type,$title,$message,$giver,$receiver,$amount);
        public function getUserUpdates($user);
        public function getAdminUpdates();
        public function getSidebarUpdates($user);        
        public function block($d);
        public function getDashboardStats($user);
        public function getRecentPaymentHistory($user);
        public function sendOTP($number);
        public function generateActivationPin();
        public function useActivationPin($user,$pin);
        public function getActivationPins();
        public function sendPhoneVerificationEmail($number);
        public function r2($user);
}
 ?>