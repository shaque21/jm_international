<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Rules\MatchOldPassword;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Message;

class UserController extends Controller
{
    
    public function index(){
        $allUsers=User::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.users.all',compact('allUsers'));
    }
    public function add(){
        return view('admin.users.add');
    }
    public function view($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.users.view',compact('data'));
    }
    public function insert(Request $request){
        $request->validate([
            'name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role_id'=>'required',
            'photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

        $slug = Str::of($request->name)->slug('-'). '-' .time();
        $insert=User::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'password' => Hash::make($request->password),
            'role_id'=>$request->role_id,
            'slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $fileName = $slug.'('.$insert.')'.'-'.time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/users' directory
            $path = $image->move(public_path('/uploads/users'), $fileName);
            User::where('id',$insert)->update([
                'photo'=>$fileName,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }
        // if($request->hasFile('photo')){
        //     $image = $request->file('photo');
        //     $image_name = $slug.'('.$insert.')'.'-'.time().'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$image_name));
            
        //     User::where('id',$insert)->update([
        //         'photo'=>$image_name,
        //         'updated_at'=>Carbon::now()->toDateTimeString(),
        //     ]);
        // }
        if($insert){
            $request->session()->flash('success', 'User Added Successfully!');
            return redirect('/admin/users/add');

        return redirect(route('verification.notice'))->with('status', 'A verification link has been sent to your email address.');
        }
        else{
            $request->session()->flash('error', 'User is not Added!');
            return redirect('/admin/users/add');
        }
    }
    public function customer_insert(Request $request){
        $request->validate([
            'name'=>'required|max:70|min:5',
            'role_id'=>'required',
            'photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

        $slug = Str::of($request->name)->slug('-'). '-' .time();
        $email = preg_replace('/\s+/', '', trim($request->name)) . "@gmail.com";
        $password = 'customer@123';
        $insert=User::insertGetId([
            'name'=>$request->name,
            'email'=> $email,
            'mobile'=>'01627309844',
            'password' => Hash::make($password),
            'role_id'=>$request->role_id,
            'slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $fileName = $slug.'('.$insert.')'.'-'.time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/users' directory
            $path = $image->move(public_path('/uploads/users'), $fileName);
            User::where('id',$insert)->update([
                'photo'=>$fileName,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
        }
        // if($request->hasFile('photo')){
        //     $image = $request->file('photo');
        //     $image_name = $slug.'('.$insert.')'.'-'.time().'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$image_name));
            
        //     User::where('id',$insert)->update([
        //         'photo'=>$image_name,
        //         'updated_at'=>Carbon::now()->toDateTimeString(),
        //     ]);
        // }
        if($insert){
            $request->session()->flash('success', 'Customer Added Successfully!');
            return redirect('/admin/orders');

        return redirect(route('verification.notice'))->with('status', 'A verification link has been sent to your email address.');
        }
        else{
            $request->session()->flash('error', 'User is not Added!');
            return redirect('/admin/orders');
        }
    }
    // public function insert(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|max:70|min:5',
    //         'mobile' => 'required|min:11|max:15',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|confirmed|min:8',
    //         'role_id' => 'required',
    //         'photo' => 'mimes:jpeg,jpg,png,gif',
    //     ]);

    //     // $otp = rand(100000, 999999); // Generate a 6-digit OTP
    //     $otp = 223344; // Generate a 6-digit OTP

    //     // Store user data in the session (except the file)
    //     $userData = $request->except('photo');
    //     Session::put('user_data', $userData);
    //     Session::put('otp', $otp);

    //     // Save the uploaded file temporarily
    //     if ($request->hasFile('photo')) {
    //         $tempPath = $request->file('photo')->store('temp'); // Save in the 'temp' directory
    //         Session::put('photo_path', $tempPath); // Store the path in the session
    //     }

    //     // Send OTP to the email
    //     Mail::send([], [], function (Message $message) use ($request, $otp) {
    //         $message->to($request->email)
    //             ->subject('Your OTP for Account Creation')
    //             ->html("Your OTP is: <strong>$otp</strong>"); // Use `html()` for setting the email body
    //     });

    //     return redirect()->route('admin.users.verify_otp');
    // }


    // public function showOtpForm()
    // {
    //     return view('admin.users.verify_otp');
    // }
    // public function verifyOtp(Request $request)
    // {
    //     $request->validate(['otp' => 'required|numeric']);

    //     $storedOtp = Session::get('otp');
    //     $userData = Session::get('user_data');
    //     $photoPath = Session::get('photo_path');

    //     if ($storedOtp && $userData && $request->otp == $storedOtp) {
    //         $slug = Str::of($userData['name'])->slug('-') . '-' . time();

    //         // Create the user
    //         $insert = User::create([
    //             'name' => $userData['name'],
    //             'email' => $userData['email'],
    //             'mobile' => $userData['mobile'],
    //             'password' => Hash::make($userData['password']),
    //             'role_id' => $userData['role_id'],
    //             'slug' => $slug,
    //             'created_at' => Carbon::now(),
    //         ]);

    //         // Move the temporary file to the permanent directory
    //         if ($photoPath) {
    //             $fileName = $slug . '(' . $insert->id . ')-' . time() . '.' . pathinfo($photoPath, PATHINFO_EXTENSION);
    //             $finalPath = Storage::move($photoPath, "uploads/users/$fileName");

    //             // Update the user's photo field
    //             $insert->update(['photo' => $fileName]);
    //         }

    //         // Clear session data
    //         Session::forget('otp');
    //         Session::forget('user_data');
    //         Session::forget('photo_path');

    //         return redirect()->route('admin.users.add')->with('success', 'User created successfully!');
    //     }

    //     return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
    // }




    public function edit($slug){
        $users = User::where('status',1)
                    ->where('slug',$slug)->firstOrFail();
        return view('admin.users.edit',compact('users'));
    }
    public function update(Request $request){
        // return $request->all();
        $request->validate([
            'name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255',
            // 'password' => 'required|string|confirmed|min:8',
            'role_id'=>'required',
            'photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

        $url_slug = Str::of($request->name)->slug('-').'-'.time();
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            // 'password' => Hash::make($request->password),
            'mobile'=>$request->mobile,
            'role_id'=>$request->role_id,
            'slug'=>$url_slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ];
        // upload Image
        // if($request->hasFile('photo')){
        //     $image = $request->file('photo');
        //     $image_name = $url_slug.'('.$request->id.')'.time().'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$image_name));
        //     $data['photo'] = $image_name;
        // }
        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $fileName = $url_slug.'('.$request->id.')'.'-'.time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/users' directory
            $path = $image->move(public_path('/uploads/users'), $fileName);
            $data['photo'] = $fileName;
        }
        $update = User::where('status',1)->where('id',$request->id)->update($data);
        if($update){
            Session::flash('update_success','Users Information Updated Successfully !');
            return redirect('/admin/users/view/'.$url_slug);
        }
        else{
            Session::flash('update_error','Something were wrong');
            return redirect('/admin/users/view/'.$url_slug);
        }
    }
    public function soft_delete($slug){
        $soft_del = User::where('status',1)->where('slug',$slug)
            ->update([
                'status'=>0,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);

        if($soft_del){
            Session::flash('delete_success','This user is deleted temporarily.');
            return redirect('/admin/users');
        }
        else{
            Session::flash('delete_error','Something Went wrong!');
            return redirect('/admin/users');
        }
    }

    public function user_profile($slug){
        $data=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.users.user_profile',compact('data'));
    }

    public function edit_user_password($slug){
        $users=User::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.users.edit_password',compact('users'));
    }
    public function password_update(Request $request){
        // return $request->all();
        $request->validate([
            'c_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
            
        ],[

        ]);
   
        $update = User::find($request->id)->update(['password'=> Hash::make($request->password)]);
        
        if($update){
            Session::flash('update_success','Password Updated Successfully !');
            return redirect('/admin/profile/user_profile/'.$request->slug);
        }
        else{
            Session::flash('update_error','Something were wrong');
            return redirect('/admin/profile/user_profile/'.$request->slug);
        }
        
    }
    public function edit_user_profile($slug){
        $users = User::where('status',1)
                    ->where('slug',$slug)->firstOrFail();
        return view('admin.users.edit_user_profile',compact('users'));
    }
    public function profile_update(Request $request){
        // return $request->all();
        $request->validate([
            'name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255',
            // 'password' => 'required|string|confirmed|min:8',
            'role_id'=>'required',
            'photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

        $url_slug = Str::of($request->name)->slug('-').'-'.time();
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            // 'password' => Hash::make($request->password),
            'mobile'=>$request->mobile,
            'role_id'=>$request->role_id,
            'slug'=>$url_slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ];
        // upload Image
        // if($request->hasFile('photo')){
        //     $image = $request->file('photo');
        //     $image_name = $url_slug.'('.$request->id.')'.time().'.'.$image->getClientOriginalExtension();
        //     Image::make($image)->resize(250,250)->save(base_path('public/uploads/users/'.$image_name));
        //     $data['photo'] = $image_name;
        // }
        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $fileName = $url_slug.'('.$request->id.')'.'-'.time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/users' directory
            $path = $image->move(public_path('/uploads/users'), $fileName);
            $data['photo'] = $fileName;
        }
        $update = User::where('status',1)->where('id',$request->id)->update($data);
        if($update){
            Session::flash('update_success','My Information Updated Successfully !');
            return redirect('/admin/profile/user_profile/'.$url_slug);
        }
        else{
            Session::flash('update_error','Something were wrong');
            return redirect('/admin/profile/user_profile/'.$url_slug);
        }
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
