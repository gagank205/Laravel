<?php
namespace App\Http\Controllers;

use App\common_model\Dashboard;
use App\common_model\User;
use App\common_model\DealPostManagement;
use Illuminate\Http\Request;
use Auth;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Db::table('users')->where('user_role_id',3)->get()->count(); 
    	$member = Db::table('users')->where('user_role_id',4)->get()->count();
    	$coupon = Db::table('coupon_management')->get()->count();
    	$frame = Db::table('frame_management')->get()->count(); 
       return view('backend.dashboard')->with(['user'=>$user,'member'=>$member,'coupon'=>$coupon,'frame'=>$frame]);
    }
}
