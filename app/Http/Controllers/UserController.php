<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PatientRecord;
use Illuminate\Support\Facades\Auth;
use App\http\Requests\UserRequest;
use function redirect;
use save;
use image;
use Validator;





class UserController extends Controller
   {
public function index(){
        return view('welcome');
    }




    public function dashboard(){ 
        $user = Auth::user();
        $userlist = [];
        $records = PatientRecord::all();
        if ($user->role === 'Admin' || $user->role === 'superadmin') {
            $userlist = User::all();
        }
        return view('dashboard', compact(['user', 'userlist','records']));
        }
    


public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'role'=>'required',
            'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
            'password'=>'required'
        ]);
            if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }

      $user = new User();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->role = $request->input('role');
      $user->password = Hash::make($request->password);
    //   $user->password = $request->input('password');

      if ($request->hasFile('image')){
          $image = $request->file('image');
          $extension = $image->getClientOriginalExtension();
          $filename = time().'.'.$extension;
          $image->move('uploads/image',$filename);
          $user->image = $filename;

          
        //   Image::make($image)->resize(300,300)->save(public_path(). '/uploads/image/'.$filename);

        //   $user = Auth::user();
        //   $user->image = $filename;
      }else{
          return $request;
          $user->image='';
      }
      $user->save();
      return redirect('/dashboard')->withErrors(['status' => 'user created successfully']);
        

            //  $input=(object) $request;

            // $user_created = User::create([
            //     'name' => $input['name'],
            //     'email' => $input['email'],
            //     'role' => $input['role'],
                
          

      

                
            //     'password' => Hash::make($input['password']),
            // ]);
            // if (!$user_created) {
            //     return redirect()->back()->withErrors(['error' => 'an error occurred : user cannot be created']);
            // }
            // return redirect('/dashboard')->withErrors(['status' => 'user created successfully']);
    }
    



    // public function createpatients(Request $input){
    //     $input->validate([
    //         'patient_name' => ['required', 'string', 'max:255'],
    //         'patient_condition' => ['string', 'max:100'],
    //         // 'added_by' => ['required'],
    //     ]);
    
    //     $record_created = PatientRecord::create([
    //         'patient_name' => $input['patient_name'],
    //         'patient_condition' => $input['patient_condition'],
    //         // 'added_by' => $input['added_by'],
    //     ]);
    //     if (!$record_created) {
    //         return redirect()->back()->withErrors(['error' => 'an error occurred : record cannot be created']);
    //     }
    
    //     return redirect('/dashboard')->withErrors(['status' => 'record created successfully']);
    // }



// public function edit(Request $request,$id){
//     $userlist = User::findorFail($id);
//     return view('edituser')->with('users',$userlist);

// }

public function update(UserRequest $request,$id){
   
  
// $this->validate($request,[
//     'name'=>'required',
//     'email'=>'required',
//     'role'=>'required'
// ]);
    $user = User::find($id);
   
    //    $user->name = $request->input('name');
    //    $userlist->email = $request->input('email');
    //    $userlist->role = $request->input('role');
   


//    $user->update(["name" => $request['name'], "email"=> $request['email'], "role"=> $request['role'] ]);
$input = $request -> all();

$user->fill($input)->save();

   return redirect('/dashboard')->withErrors(['status' => 'record successfully updated']);
}



// public function delete($id){
//     $user->delete($id);
//     return redirect('/dashboard')->with('status','deleted');
// }

public function delete(Request $request, $id){
    $userlist = User::find($id);
    $userlist->delete();

    return redirect('/dashboard')->with('status','Your Data is deleted');
}



 }