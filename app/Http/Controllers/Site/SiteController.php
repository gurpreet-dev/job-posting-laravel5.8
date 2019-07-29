<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubscriptionPlan;
use App\Subscription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Contact;
use Auth;
use DB;

class SiteController extends Controller
{
    public function home(){
        $features = SubscriptionPlan::with(['features'])->get();
        $experiences = \App\Experience::whereHas('user')->with(['user'])->where('featured', 1)->get();
        $rated = \App\Job::where('featured', 1)->get();
        return view('site.home', ['features' => $features, 'experiences' => $experiences, 'rated' => $rated]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role'  => 'doctor',
            'password' => Hash::make($data['password']),
            'status'    =>  1
        ]);
    }

    public function buyPlan(Request $request, $id){

        if(Auth::user()->role == 'applicant'){
            return redirect(route('user-profile'))->with('warning', 'Subscription plan is only for doctors!');
        }

        $id = \App\Hash::decode($id);
        $plan = SubscriptionPlan::where(['id' => $id])->first();

        if(Auth::id()){
            $card = \App\Card::where('user_id', Auth::id())->first();
        }else{
            $card = [];
        }

        \Stripe\Stripe::setApiKey('sk_test_SXivWvQ4rTNrCtDyy8apin8e00WRYNkyo0');

        if($request->isMethod('post')){
            //dd($request->all());
            /****************/

            $customer_id = '';
            $email = $request['email'];

            if(isset($request['email'])){
                $this->validator($request->all())->validate();
                event(new Registered($user = $this->create($request->all())));
                $success[] = 'Registration successfull!';
                $user_id = $user->id;
            }else{
                $email = Auth::user()->email;
                $customer_id = Auth::user()->stripe_customer;
                $user_id = Auth::id();
            }

            if($customer_id != '' && $customer_id != null){
                $customer = \Stripe\Customer::retrieve($customer_id);
            }else{
                $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source'  => $request->stripeToken
                ));
                $customer_id = $customer->id;
                User::where('id', $user_id)->update(['stripe_customer' => $customer_id]);
            } 

            /***************/

            $amount = $plan->price;
            $charge = \Stripe\Charge::create(['customer' => $customer_id, 'amount' => $amount * 100, 'currency' => 'USD']);
            $chargeJson = $charge->jsonSerialize();
            
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
                
		    	if($chargeJson['status'] == 'succeeded'){
                    $post = [
                        'user_id'           =>  $user_id,
                        'plan_id'           =>  $id,
                        'cc_number'         =>  $request->cc_number,
                        'transaction_id'    =>  $chargeJson['balance_transaction'],
                        'amount_paid'       =>  $amount,
                        'payment_status'    =>  'completed',
                        'payment_gateway'   =>  'Credit card - Stripe',
                        'payment_date'      =>  \Carbon\Carbon::now()->toDateTimeString(),
                        'status'            =>  1
                    ];
    
                    // if($plan->duration == 'monthly'){
                    //     $post['end_date']          = \Carbon\Carbon::parse($post['start_date'])->addMonths(1);
                    // }
    
                    // if($plan->duration == 'annually'){
                    //     $post['end_date']          = \Carbon\Carbon::parse($post['start_date'])->addMonths(12);
                    // }
    
                    $subscription = Subscription::create($post); 
                    $user = User::find($user_id);
                    $user->subscription_id   = $subscription->id;
                    $user->subscribed   = '1';
                    $user->plan_id   = $id;
                    $user->subscription_date = \Carbon\Carbon::now()->toDateTimeString();
                    $user->save();



                    if(isset($request['email'])){

                        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'doctor', 'status' => 1])) {
                            return redirect(route('user-profile'))->with('registration', '<strong>Success! </strong>Registration Successfull!')->with('payment_success', '<strong>Success! </strong>Congratulations for the subscription. Payment Successfull with transaction ID: '.$chargeJson['balance_transaction']);
                        }else{
                            return redirect()->back()->with('registration', '<strong>Success! </strong>Registration Successfull! Please <a href="'.route("login").'">Login</a> to continue.')->with('payment_success', '<strong>Success! </strong>Payment Successfull with transaction ID: '.$chargeJson['balance_transaction']);
                        }

                    }else{
                        return redirect(route('user-profile'))->with('payment_success', '<strong>Success! </strong>Congratulations for the subscription. Payment Successfull with transaction ID: '.$chargeJson['balance_transaction']);
                    }
                }else{
                    if(isset($request['email'])){
                        return redirect()->back()->with('registration', 'Registration Successfull!')->with('payment_error', '<strong>Oops! </strong>Payment fail! Reason: '.$chargeJson['failure_message']);
                    }else{
                        return redirect()->back()->with('payment_error', '<strong>oops! </strong>Payment fail! Reason: '.$chargeJson['failure_message']);
                    }
                }
            }
        }
        
        return view('site.buy-plan', ['plan' => $plan, 'card' => $card]);
    }

    public function contact(Request $request){

        if($request->isMethod('post')){

            $post = $request->except('_token');
            $insert = Contact::create($post);
            
            if(\App\Config::get_field('email') != ''){

                if($insert){

                    Mail::send('emails.contact_to_admin', ['data' => $post], function ($message)
                    {
                        $message->to(\App\Config::get_field('email'), \App\Config::get_field('site_title'))->subject('Contact us query recieved');
                        $message->from(\App\Config::get_field('email'), \App\Config::get_field('site_title'));
                    });
                    return redirect(route('contact-us'))->with('success', 'Your query has been submitted to our support. We will contact you soon.');
                }else{
                    return back()->withInput()->with('error', 'Error in submitting a query. Please try again');
                }
            }else{
                return back()->withInput()->with('error', 'Our support team is not available right now. Please try again');
            }
        }

        return view('site.contact');

    }

    public function blogs(){
        $blogs = \App\Blog::where('status', 1)->orderBy('id', 'desc')->simplePaginate(15);
        return view('site.blogs', ['blogs' => $blogs]);
    }

    public function blog($slug){
        $blog = \App\Blog::where('slug', $slug)->first();

        if(empty($blog)){
            return redirect(route('blogs'));
        }

        return view('site.blog', ['blog' => $blog]);
    }

    public function addNewsletter(){

        if(isset($_GET['email'])){
            $email = $_GET['email'];
            if(!empty($_GET['email']) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                // MailChimp API credentials
                $apiKey = env('MAILCHIMP_API_KEY');
                $listID = env('MAILCHIMP_LIST_ID');
                
                // MailChimp API URL
                $memberID = md5(strtolower($email));
                $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
                $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
                
                // member information
                $json = json_encode([
                    'email_address' => $email,
                    'status'        => 'subscribed',
                    'merge_fields'  => [
                        'FNAME'     => '',
                        'LNAME'     => ''
                    ]
                ]);
                
                // send a HTTP POST request with curl
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                
            }

            $user = \App\User::where('email', $_GET['email'])->first();

            if(!empty($user)){
                return redirect('login?email='.$_GET['email'])->with('info', 'Newsletter subscribed successfully!');
            }else{
                return redirect('register');
            }
        }else{
            return redirect('/');
        }
        
    }

    public function page($slug){
        $page = DB::table('static_pages')->where('slug', $slug)->first();

        if(empty($page)){
            return redirect('/');
        }

        return view('site.static-page', ['page' => $page]);
    }

    public function faq(){
        $faqs = DB::table('faqs')->orderby('id', 'desc')->simplePaginate(20);
        return view('site.faq', ['faqs' => $faqs]);
    }

}
