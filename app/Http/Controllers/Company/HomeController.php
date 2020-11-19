<?php

namespace App\Http\Controllers\Company;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

use Notification;
use Illuminate\Support\Facades\Mail;

use App\Internship_Post;

use App\Add_Company_Coordinator;

class HomeController extends Controller
{

    protected $redirectTo = '/company/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company.auth:company');
    }

    /**
     * Show the Company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('company.home');
    }

    //Company Profile
    public function profile(){
        return view('company.profile');
    }

    //add coordinator
    public function addNewCoShow(){
        return view('company.addCoordinator');
    }
    //store new coordinator
    public function addNewCoordinatorStore(Company $company, Request $request)
    {
        $request->validate(['name' => 'required|max:255',
        'designation' => 'required|max:255|',
        'phone' => 'required|min:10',
        'email' => 'required|email|max:255|unique:add__Company__Coordinators',
        'password' => 'required|min:6|confirmed',
        ]);
        $data = array(
            'name' => $request->get('name'),
            'designation' => $request->get('designation'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        );
        
        Add_Company_Coordinator::create($data);
        return redirect()->back()->with('status', 'New Coordinator Acccount Created successfully.');
        
    }

    //Company add post
    public function addPost(){
        return view('company.postInternship');
    }

    public function addPostSave(Request $request){
        $company_id = Auth::guard('company')->user()->getId();
        $request->validate([
        'co_details' => 'required','overview'=> 'required','duration'=> 'required','recruitment'=> 'required','position'=> 'required','modeofinterview'=> 'required','workinghours'=> 'required','ctc'=> 'required','bond'=> 'required','stipend'=> 'required',
        ]);
        $data = array(
            'co_details' => $request->get('co_details'),
            'overview' => $request->get('overview'),
            'duration' => $request->get('duration'),
            'recruitment' => $request->get('recruitment'),
            'position'=>$request->get('position'),
            'modeofinterview'=> $request->get('modeofinterview'),
            'workinghours'=> $request->get('workinghours'),
            'ctc'=> $request->get('ctc'),
            'bond'=> $request->get('bond'),
            'stipend'=> $request->get('stipend'),
            'is_posted'=> false,
            'is_completed'=> false,
            'company_id'=> $company_id,
      );
    //   dd($data);
      Internship_Post::create($data);
      return redirect()->back()->with('status', 'Internship Post Created And Submited To CPI Coordinator! Thank you.');
    }
    

    //Company working internship
    public function workingInternship(){
        return view('company.workingInternship');
    }

    //Company history
    public function history(){
        return view('company.history');
    }

    //Company give feedback
    public function giveFeedback(){
        return view('company.giveFeedback');
    }
}