<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Admin\Admin;
use DataTables;
use App\Admin\Feedback;
class DashboardController extends Controller
{
    public function dashboardAction()
    {
      return view('admin.dashboard');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');

    }
    public function editProfile()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.editProfile',[ 
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email'
        ]);

        try {
            $user = Admin::where(['id' => Auth::user()->id])->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            if($user){

                return redirect('admin/dashboard')->with('success','Successfully Updated');
            }else{
                return redirect()->back()->with('error','Something Went Wrong Try Again');
            }
        } catch (\Exception $e) {

            return back()->with('error',$e->getMessage());
        }
    }


    public function editPassword()
    {
        return view('admin.profile.editPassword');
    }
    public function updateProfilePassword(Request $request)
    {
            $user_id = Auth::guard('admin')->user()->id;
            $user = Admin::findOrFail($user_id);
            $this->validate($request, [
                'old_password' => 'required',
                'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required|min:8'
            ]);

        if (Hash::check($request->old_password, $user->password)) {
        $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();


        $request->session()->flash('success', 'Password changed');
                return redirect('admin/dashboard');

        } else {
                
                return back()->with('error','Old Password Not Matching Our Records');
        }
    }

    public function feedbackList(Request $request)
    {
        if ($request->ajax()) {
            $data =  Feedback::with('user')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('username', function($row){
       
                            $name = $row->user->name;
      
                            return $name;
                    })
                    ->addColumn('created_at', function($row) {
                        $createdAt = \Carbon\Carbon::parse($row->created_at);
                        return $createdAt->diffForHumans();
                    })
                    ->rawColumns(['username','created_at'])
                    ->make(true);
        }
          
        return view('admin.feedback');
    }
}
