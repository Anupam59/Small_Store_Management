<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use App\Models\StoreModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use function PHPUnit\Framework\isEmpty;
use function Ramsey\Uuid\Generator\timestamp;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role > 2 && $request->segment(1) != 'user-profile' && $request->segment(1) != 'user-pass-reset' && $request->segment(1) != 'user-passreset') {
                return redirect('dashboard');
            }
            return $next($request);
        });
    }

    public function UserProfile(){
        return view('Admin/Pages/UserPages/UserProfilePage');
    }

    public function UserIndex(){
        $role = auth()->user()->role;
        $Users = User::where('role','>=', $role)->orderBy('role','asc')->paginate(15);
        if ($role <= 2){
            return view('Admin/Pages/UserPages/UserListPage',compact('Users'));
        }else{
            return redirect('/dashboard');
        }

    }

    public function UserCreate(){
        $Department = DepartmentModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();
        return view('Admin/Pages/UserPages/UserCreatePage',compact('Department','Store'));
    }

    public function UserEntry(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:users',
            'number' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:5|max:12',
            'confiem_password' => 'required|same:password',
        ]);

        $data =  array();
        $data['name'] = $request->name;
        $data['designation'] = $request->designation;
        $data['email'] = $request->email;
        $data['number'] = $request->number;
        $data['username'] = $request->username;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;
        $data['status'] = 1;
        $data['creator'] = $request->creator;
        $data['modifier'] = $request->creator;

        $dept_admin = $request->input('dept_admin');
        $dept_ao = $request->input('dept_ao');
        $store_admin = $request->input('store_admin');
        $store_manager = $request->input('store_manager');
        $role = $request->input('role');
        if ($role == 3){
            $data['dept_admin'] = implode(" ",$dept_admin);
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
            $data['store_admin'] = null;
        }if ($role == 4){
            $data['dept_admin'] = null;
            $data['dept_ao'] = implode(" ",$dept_ao);
            $data['store_manager'] = null;
            $data['store_admin'] = null;
        }if ($role == 5){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = implode(" ",$store_manager);
            $data['store_admin'] = null;
        }if ($role == 6){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
            $data['store_admin'] = implode(" ",$store_admin);
        }if ($role == 1 || $role == 2){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
            $data['store_admin'] = null;
        }

        $image = $request->file('user_image');
        if ($image) {
            $image_name = time();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_resize = Image::make($image->getRealPath())->resize(400, 400);
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'Images/Users/';
            $image_url = $upload_path . $image_full_name;
            $image_resize->save($image_url);
            $data['user_image'] = $image_full_name;
            $res = User::insert($data);
            if ($res){
                return back()->with('success_message','User Add Successfully!');
            }else{
                return back()->with('error_message','User Add Fail!');
            }

        }else{
            $data['user_image'] = null;
            $res = User::insert($data);
            if ($res){
                return back()->with('success_message','User Add Successfully!');
            }else{
                return back()->with('error_message','User Add Fail!');
            }
        }


    }

    public function UserEdit($id){
        $Department = DepartmentModel::where('status',1)->get();
        $Store = StoreModel::where('status',1)->get();
        $Users = User::where('id',$id)->first();
        return view('Admin/Pages/UserPages/UserUpdatePage',compact('Users','Department','Store'));
    }

    public function UserUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'number' => 'required|unique:users,number,'.$id,
            'username' => 'required|unique:users,username,'.$id,
        ]);

        $data =  array();
        $data['name'] = $request->name;
        $data['designation'] = $request->designation;
        $data['email'] = $request->email;
        $data['number'] = $request->number;
        $data['username'] = $request->username;
        $data['role'] = $request->role;
        $data['status'] = $request->status;
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");


        $dept_admin = $request->input('dept_admin');
        $dept_ao = $request->input('dept_ao');
        $store_admin = $request->input('store_admin');
        $store_manager = $request->input('store_manager');

        $role = $request->input('role');
        if ($role == 3){
            $data['dept_admin'] = implode(" ",$dept_admin);
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
            $data['store_admin'] = null;
        }if ($role == 4){
            $data['dept_admin'] = null;
            $data['dept_ao'] = implode(" ",$dept_ao);
            $data['store_manager'] = null;
            $data['store_admin'] = null;
        }if ($role == 5){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = implode(" ",$store_manager);
            $data['store_admin'] = null;
        }if ($role == 6){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
            $data['store_admin'] = implode(" ",$store_admin);
        }if ($role == 1 || $role == 2){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
            $data['store_admin'] = null;
        }


        $Users = User::where('id',$id)->first();
        $old_image = $Users->user_image;
        $upload_path = 'Images/Users/';
        $image = $request->file('user_image');


        if ($image) {
            if ($old_image){
                unlink($upload_path.$old_image);
            }
            $image_name = time();
            $ext = strtolower($image->getClientOriginalExtension());
            $image_resize = Image::make($image->getRealPath())->resize(400, 400);
            $image_full_name = $image_name . '.' . $ext;
            $image_url = $upload_path . $image_full_name;
            $image_resize->save($image_url);
            $data['user_image'] = $image_full_name;
            $res = User::where('id','=',$id)->update($data);
            if ($res){
                return back()->with('success_message','User Update Successfully!');
            }else{
                return back()->with('error_message','User Update Fail!');
            }

        }
        else{
            $res = User::where('id','=',$id)->update($data);
            if ($res){
                return back()->with('success_message','User Update Successfully!');
            }else{
                return back()->with('error_message','User Update Fail!');
            }
        }
    }










    public function UserPasswordUpdatePage($id){
        $user = User::where('id','=',$id)->first();
        if (Auth::user()->role <=2){
            return view('Admin/Pages/UserPages/UpdatePassword',compact('user'));
        }
        return back();
    }

    public function UserPasswordUpdate(Request $request, $id){
        $validation = $request->validate([
            'password' => 'required|min:5|max:12',
            'confiem_password' => 'required|same:password',
        ]);

        $data =  array();
        $data['password'] = Hash::make($request->password);
        $data['modifier'] = $request->creator;
        $data['modified_date'] = date("Y-m-d h:i:s");

        $userS = User::where('id','=',$id)->first();
        $userole = $userS->role;

        if (Auth::user()->role ==1){
            $res = User::where('id','=',$id)->update($data);
            return back()->with('success_message','Password Update Successfully!');
        }
        if (Auth::user()->role ==2){
            if ($userole == 1){
                return back();
            }else{
                $res = User::where('id','=',$id)->update($data);
                return back()->with('success_message','Password Update Successfully!');
            }
        }
        return back()->with('error_message','Password Update Fail!');
    }


    public function UserPasswordResetPage(){
        return view('Admin/Pages/UserPages/ChangePassword');
    }


    public function UserPasswordReset(Request $request){
        $validation = $request->validate([
            'old_password' => 'required|min:5|max:12',
            'password' => 'required|min:5|max:12',
            'confiem_password' => 'required|same:password',
        ]);

        $data =  array();
        $data['password'] = Hash::make($request->password);

        $userS = User::where('id','=',Auth::user()->id)->first();
        if ($userS){
            if (Hash::check($request->old_password,$userS->password)){
                $res = User::where('id','=',Auth::user()->id)->update($data);
                return redirect('/user-pass-reset')->with('success_message','Password Reset Successfully!.');
            }else{
                return redirect('/user-pass-reset')->with('error_message','Password not matches !.');
            }
        }
    }



}
