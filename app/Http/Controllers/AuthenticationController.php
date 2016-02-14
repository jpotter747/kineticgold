<?php

namespace App\Http\Controllers;
use Mail;
use Crypt;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{

    public function login(Request $request)
    {
        $userName = $request->input('user_name');
        $data['username']=$userName;
        $data['reset'] = '';
        $data['user_name']='';
        $data['errors'] = '';
        return view('login',$data);
    }

    public function logout2(Request $request)
    {
        $this->clearSession($request);

        $data = $this->baseData();
        $data['user_name'] = '';
        $data['user_id'] = '';
        return view('welcome2',$data);
    }

    public function verify(Request $request)
    {
        \Log::info("in verify");

        $userName = $request->input('username');
        $password = $request->input('password');
        $reset = $request->input('Reset');
        if($reset != ""){
            return $this->resetPassword($userName);
        }

        $user = $this->membershipStatus($userName, $password);
        \Log::info("userName=$userName  password=$password");
        if(!$user){
            return $this->notValidLogin($request);
        }
        if ($user){
            if($user->member>1){
                $request->session()->set('user_id', $user->id);
            }
            if($user->member == 5) {
                return $this->finishMemberLogin($user, $request);
            }
            if($user->member ==1){
                return $this->verificationSent($user,$request);
            }

        }
    }

    public function notValidLogin($request)
    {
        $user = Users::where('user_name', $userName)
        ->first();
        if ($user){
            $data['reset'] = 'yes';
            \Log::info("found username");
        }else{
            $data['reset'] = '';
        }
        $data['user_name'] = '';
        $data['username'] = $userName;
        $data['user_id'] = '';
        $data['errors'] = 'Password or Username incorrect';
        \Log::info("exit 2");
    return view('login',$data);
    }



    public function verificationSent($user,$request)
    {
        \Log::info("email was Sent");

    }

    public function membershipStatus($userName, $password)
    {
        $user = Users::where('user_name', $userName)
           ->where('password',$password)->first();
        return $user;
    }

    public function finishMemberLogin($user, Request $request)
    {
        $username = $user->first_name.' '.$user->last_name;
        $request->session()->set('user_name', $username);
        $request->session()->set('user_id', $user->id);
        $request->session()->save();
        $data = $this->basedata();
        $data['user_name'] = $username;
        $data['user_id'] = $user->id;
        \Log::info("exit 1");
        return view('welcome2',$data);
    }

    public function register(Request $request)
    {
        \Log::info('in register');

        $data['user_name']='';
        $data['user_id'] = '';
        $data['errors']= [] ;
        $userId = $request->session()->get('user_id');
        if($userId){
            $user = Users::find($userId);
            if ($user->member == 2){
                $data = $this->basedata();
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = $userId;
                \Log::info("exit 1");
                return view('register2',$data);
            }
            if ($user->member == 3){
                $data = $this->basedata();
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = $userId;
                \Log::info("exit 1");
                return view('payment',$data);
            }
            if ($user->member == 4){
                $data = $this->basedata();
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = $userId;
                \Log::info("exit 1");
                return view('awaiting_payment',$data);
            }
            if ($user->member == 5){

                $data = $this->basedata();
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = $userId;
                \Log::info("exit 1");
                return view('registration_complete',$data);
            }


        }

        return view('register',$data);
    }




    public function finishRegistering(Request $request)
    {
        \Log::info("in finishRegistering");


        $users = new Users;
        $user = $users->checkForRegistration($request);
        if($user){
            if($user->member == 5){
                return $this->memberConfirmed($user, $request);
            }
        }else{
            //not registered -  verify email
            $user = $this->initialRegistration($request);
            $this->emailConfirmation($user);
            return $this->verifyEmail($user);
        }
        $data = $this->basedata();
        $data['username'] = '';
        $data['user_name'] = '';
        $data['user_id'] = '';
        \Log::info("exit 1");
        return view('register2',$data);
    }

    public function prepayment(Request $request)
    {
        \Log::info("in prepayment");
        $userId = $request->session()->get('user_id');
        $payMethod = $request->session()->get('paymethod');


        if($userId){
            $user = Users::find($userId);
            if ($user->member >2 && $user->member<5){
                $homePhone = $request->input('home_phone');
                $cellPhone = $request->input('cell_phone');
                $addr1 = $request->input('addr1');
                $addr2 = $request->input('addr2');
                $city = $request->input('city');
                $state = $request->input('state');
                $country = $request->input('country');
                $postalCode = $request->input('postal_code');
                $socialSecurity = $request->input('social_security');
                $user->home_phone = $homePhone;
                $user->cell_phone = $cellPhone;
                $user->addr1 = $addr1;
                $user->addr2 = $addr2;
                $user->city = $city;
                $user->state = $state;
                $user->country = $country;
                $user->postal_code = $postalCode;
                $user->social_security = $socialSecurity;
                $user->member = 3;
                $user->save();
            }
            if($payMethod == 'Mail'){
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = '';
                \Log::info("exit 1");
                $user->member = 4;
                $user->save();
                return view('awaiting_payment',$data);
            }
            $data = $this->basedata();
            $data['username'] = '';
            $data['user_name'] = '';
            $data['user_id'] = '';
            \Log::info("exit 1");
            return view('payment',$data);
        }
    }

    public function processPayment($user, $cc, $productId)
    {
        $transaction = new Transactions;
        $newTrans = $transaction->newTransaction($user->id);
        $role = 2;
        $productId = 1;
        $payBonus = 1;
        $transaction->loadProductInTransaction($newTrans, $user->id, $role, $productId);

    }

    public function payment(Request $request)
    {
        $userId = $request->session()->get('user_id');
        if($userId) {
            $user = Users::find($userId);
            $cc = $this->saveCardInfo($request,$user);


            $pp = $this->processPayment($user,$cc,$productId);
            $user->member = 5;
            $user->save();
            $data = $this->basedata();
            $username = $user->first_name . ' ' . $user->last_name;
            $request->session()->set('user_name', $username);
            $request->session()->set('user_id', $user->id);
            $request->session()->save();
            $data = $this->basedata();
            $data['user_name'] = $username;
            $data['user_id'] = $user->id;
            $data['username'] = $username;
            $data['email'] = $user->email;
            return view('thankyou', $data);
        }
    }

    public function saveCardInfo($request,$user)
    {
        $cc = new customer_credit_cards;
        $cc->name_on_card = $request->input('billing_name');
        $cc->credit_card_number = $request->input('credit_card');
        $cc->ex_month = $request->input('month');
        $cc->exp_year = $request->input('year');
        $cc->security_code = $request->input('security_code');
        $cc->user_id = $user->id;
        $cc->save();
        return $cc;

    }



    public function resetPassword($userName)
    {
        \Log::info("in resetPassword");
        $user = Users::where('user_name', $userName)->first();
        if($user){
            \Log::info("matching username = $userName");
            $email = $user->email;
            \Log::info("email=$email");
            $data['email'] = $email;
            $data['user_name'] = '';
            $data['user_id'] = '';
            \Log::info("exit 3");
            return view('reset',$data);
        }
        else{
            \Log::info("No matching username = $userName");
            $data['user_name'] = '';
            $data['user_id'] = '';
            $data['username']=$userName;
            $data['errors'] = 'UserName not in system';
            \Log::info("exit 4");
            return view('login',$data);
        }

    }

    public function baseData()
    {
        $data['errors'] = [];
        $data['imageUrl'] = '../images/EarthRise.jpg';
        $data['message'] = 'Eco-nomix System\'s purpose is to provide the highest
            quality products to its customers that will help them improve
            their lives physically, emotionally, spirtually and economically.';
        return $data;
    }

    public function clearSession(Request $request)
    {
        $request->session()->set('user_name', '');
        $request->session()->set('user_id','');
        $request->session()->save();
    }

    public function sendEmailReminder($user, $reminder)
    {
        Mail::send('emails.reminder', ['user' => $user], function ($message) use ($user, $reminder) {
            $pathToImage = "/images/Economix3731_Fotor.jpg";
            $message->from('admin@eco-nomix.com', 'Admin');
            $message->subject('Reminder');
            $username = $user->first_name.' '.$user->last_name;
            $testemail = 'jpotter747@yahoo.com';
            $message->to($testemail, $username)->subject('Your Reminder!');
            //$message->sender($address,$name);
            //$message->cc($address,$name);
            //$message->bcc($address,$name);
            //$message->replyTo($address,$name);
            //$message->priority($level);
            //$message->attach($pathtoFile, array $options=[]);
            //      $options = ['as'=>$display,'mime'=$mime];
            //$message->attachData($data,$name,array $options=[]);
            //$message->getSwiftMessage();
        });
    }

    public function emailVerified($userId,$key,Request $request)
    {
        $memberId = $userId;
        \Log::info("memberId = $userId   key=$key");
        $user = Users::find($userId);
        if($user){
            if($user->user_link == $key){
                // email was verified
                $user->member = 2;
                $user->save();
                $data= $this->basedata();
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = '';
                $request->session()->set('user_id', $user->id);
                $request->session()->save();
                return view('email_verification_continue',$data);
            }
            else{
                //email link tweaked
                $data= $this->basedata();
                $data['username'] = '';
                $data['user_name'] = '';
                $data['user_id'] = '';
                return view('email_verification_bad',$data);
            }
        }
        else{
            //email link tweaked
            $data= $this->basedata();
            $data['username'] = '';
            $data['user_name'] = '';
            $data['user_id'] = '';
            return view('email_verification_bad',$data);
        }

    }
    public function emailConfirmation($user)
    {
        \Log::info("in email Confirmation ");
        $image = '/images/Economix3731_Fotor.jpg';


        Mail::send('emails.email_verification', ['user' => $user,'image'=>$image], function ($message) use ($user, $image) {
            $pathToImage = "/images/Economix3731_Fotor.jpg";
            $message->from('admin@eco-nomix.org', 'Admin');
            $message->subject('Email Verification');
            $message->sender('admin@eco-nomix.org');
            $username=$user->first_name.' '.$user->last_name;
            $message->to($user->email, $username);
            $message->subject('Email Verification!');
        });
    }
    public function memberConfirmed($user, $request)
    {
        $data= $this->basedata();
        $username = $user->first_name.' '.$user->last_name;
        $request->session()->set('user_name', $username);
        $request->session()->set('user_id', $user->id);
        $request->session()->save();
        $data = $this->basedata();
        $data['user_name'] = $username;
        $data['user_id'] = $user->id;
        $data['username'] = $username;
         $data['email'] = $user->email;
        \Log::info("already a full member");
        return view('registration_complete',$data);
    }

    public function initialRegistration(Request $request)
    {
        $user = new Users;
        $user->email =$request->input('email');
        $user->user_name = $request->input('username');
        $user->password = $request->input('password');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->member = 1;
        $user->save();
        $user->user_link =  md5($user->id);
        $user->save();
        return $user;
    }

    public function verifyEmail($user)
    {
        $data= $this->basedata();
        $data['username'] = '';
        $data['user_name'] = '';
        $data['user_id'] = '';
        $data['email'] = $user->email;
        return view('email_verification',$data);
    }

}
