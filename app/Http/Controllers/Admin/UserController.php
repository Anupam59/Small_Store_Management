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
use Intervention\Image\Facades\Image;
use function PHPUnit\Framework\isEmpty;
use function Ramsey\Uuid\Generator\timestamp;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role > 2 && $request->segment(1) != 'user-profile') {
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
        $store_manager = $request->input('store_manager');
        $role = $request->input('role');
        if ($role == 3){
            $data['dept_admin'] = implode(" ",$dept_admin);
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
        }if ($role == 4){
            $data['dept_admin'] = null;
            $data['dept_ao'] = implode(" ",$dept_ao);
            $data['store_manager'] = null;
        }if ($role == 5){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = implode(" ",$store_manager);
        }if ($role == 1 || $role == 2){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
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
                $success_notification = array(
                    'success_message' => 'User Add Successfully',
                );
                return redirect('/user-list')->with($success_notification);
            }else{
                $error_notification = array(
                    'error_message' => 'User Add Fail',
                );
                return back()->with($error_notification);
            }

        }else{
            $data['user_image'] = null;
            $res = User::insert($data);
            if ($res){
                $success_notification = array(
                    'success_message' => 'User Add Successfully!',
                );
                return redirect('/user-create')->with($success_notification);
            }else{
                $error_notification = array(
                    'error_message' => 'User Add Fail!',
                );
                return back()->with($error_notification);
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
        $store_manager = $request->input('store_manager');

        $role = $request->input('role');
        if ($role == 3){
            $data['dept_admin'] = implode(" ",$dept_admin);
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
        }if ($role == 4){
            $data['dept_admin'] = null;
            $data['dept_ao'] = implode(" ",$dept_ao);
            $data['store_manager'] = null;
        }if ($role == 5){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = implode(" ",$store_manager);
        }if ($role == 1 || $role == 2){
            $data['dept_admin'] = null;
            $data['dept_ao'] = null;
            $data['store_manager'] = null;
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
                $success_notification = array(
                    'success_message' => 'User Update Successfully',
                );
                return redirect('/user-list')->with($success_notification);
            }else{
                $error_notification = array(
                    'error_message' => 'User Update Fail',
                );
                return back()->with($error_notification);
            }

        }
        else{
            $res = User::where('id','=',$id)->update($data);
            if ($res){
                $success_notification = array(
                    'success_message' => 'User Update Successfully!',
                );
                return redirect('/user-list')->with($success_notification);
            }else{
                $error_notification = array(
                    'error_message' => 'User Update Fail!',
                );
                return back()->with($error_notification);
            }
        }
    }

}
