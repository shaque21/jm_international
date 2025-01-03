<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    
    public function index(){
        $allUsers=User::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.users.all',compact('allUsers'));
    }

}
