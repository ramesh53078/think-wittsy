<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DataTables;
class UserController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function listUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->user->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    // ->addColumn('action', function($row){
       
                    //         $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
      
                    //         return $btn;
                    // })
                    // ->rawColumns(['action'])
                    ->make(true);
        }
          
        return view('admin.users.list');
    }
    
}
