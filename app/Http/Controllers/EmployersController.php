<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employer;
use App\Models\Note;
use Auth;
use App\Http\Requests\CreateNoteRequest;
use DB;


class EmployersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');

    }

   public function profile () {
         
    $user = Auth::user(); 

    return view('employers.profile')->with('user', $user);


   }

   

   public function create_note () {
         
    return view('employers.create_note');


   }



  
   public function add_note (CreateNoteRequest $request) {
         
    $user = Auth::user(); 
    $user_id = Auth::id();

    $image_name = time().'.'.$request->image->extension();  
    $request->image->move(public_path('images'), $image_name);

    $mynote = new Note;
    $mynote->note = $request->get('note');
    $mynote->user_id = $user_id;
    $mynote->category_id = $request->get('category_id');
    $mynote->image_url = $image_name;
    $mynote->save();      

    return redirect('profile');


   }


   public function get_my_notes() {

    $user = Auth::user(); 
    $user_id = Auth::id();
    $my_notes = Note::where('user_id',$user_id)->get();
  

    return view('employers.my_notes')->with('my_notes', $my_notes);


   }




}
