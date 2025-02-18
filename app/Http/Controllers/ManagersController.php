<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employer;
use App\Models\Manager;
use App\Models\EmployerList;
use App\Models\Note;
use Auth;
use App\Http\Requests\CreateEmployerRequest;
use DB;



class ManagersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


   public function profile () {
         
    $user = Auth::user(); 

    return view('managers.profile')->with('user', $user);


   }



  public function create_employer(){


   return view('managers.create_employer');


  }


   public function add_employer(CreateEmployerRequest $request) {
         
         $user = Auth::user(); 
         $user_id = Auth::id();
       
          $employer = new User;
          $employer->name = $request->get('name');
          $employer->email = $request->get('email');
          $employer->password = Hash::make($request->get('password'));
          $employer->is_employer = $request->get('is_employer');
          $employer->save();
          $last_insert_id = $employer->id;
         
          DB::table('employer_lists')->insert([
          'manager_id' => $user_id,
          'employer_id' => $last_insert_id
       ]);

      \Mail::send('emails.new_employer', $data, function($message){
        $message->from(env('MAIL_FROM'));
        $message->to(env('MAIL_FROM'), env('MAIL_NAME'));
       //$message->to(env('MAIL_FROM'), env('MAIL_NAME'))->cc('amdin@mail');
        $message->subject('New Employer Created');
      });

        return redirect('profile');


   }


    public function my_employers_notes(){
  
      $user = Auth::user(); 
      $user_id = \Auth::id();
      $my_employer_ids = EmployerList::where('manager_id', $user_id)->get();
      $my_notes = Note::where('user_id', $my_employer_ids)->pluck('note');
      return view('managers.my_employers_notes')->with('my_notes',$my_notes);



  }

}


