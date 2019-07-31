<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\CsvExport;
use App\Http\Controllers\Admin\Excel;
use App\Http\Controllers\Controller;
use Auth;
use App\common_model\FrameCart;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Admin\Response;
use App\User;

use DB;

class ReportManagementController extends Controller
{
   public function index()
   {           
        return view('backend.report_management.index');
   }
   public function data(Request $request)
   {
        if(isset($request->filter_data))
        {
            $users = FrameCart::where('user_role_id',4)->get();

        }else{

            $users = DB::table('users')->select('*')->where('user_role_id',4)->get();
        }
        return Datatables::of($users)->make(true);
    }

    public function order_details()
    {         
      return view('backend.report_management.order_details');
    }

    public function orderDate(Request $request)
    {
        if(isset($request->filter_data))
        {
            $order = Users::where('user_role_id',4)->get();

        }else{

            $order = DB::table('fream_order')->select('fream_order.*','users.first_name','frame_management.title')
                                             ->leftJoin('users','users.id','fream_order.user_id')
                                             ->leftJoin('frame_management','frame_management.id','fream_order.frame_id')
                                             ->get(); 
        }
        return Datatables::of($order)
        ->addColumn('view_order',function($order){
            return 
            '<td><a href="order-details/'.$order->order_id.'">View Order</a></td>';
            })->rawColumns(['view_order'])->make(true);
    }

 

    public function order_details_list(Request $request)
    {
        $order_id = $request->order_id;

      $details_order = DB::table('fream_order as fo')->select('fo.*','users.*')
                                                    ->leftJoin('users','users.id','fo.user_id')
                                                    ->where('fo.order_id',$order_id)
                                                    ->first();

       $order_details_array =  DB::table('frame_order_details as fod','fream_order')
                                ->select("fod.*",'users.*','fream_order.*','frame_management.*')
                                ->leftJoin('users','users.id','fod.user_id')
                                ->leftJoin('fream_order','fream_order.order_id','fod.order_id')
                                ->leftJoin('frame_management','fod.frame_id','frame_management.id')
                                ->where('fod.order_id',$order_id)->get()->toArray();


     return view('backend.report_management.order_details_list')->with('order_details_array',$order_details_array)
                                                ->with('details_order',$details_order);

    }

    // function order_details_list(Request $request) {
    //     $value = $request->session()->all();
    //     $logged_in_user = $value['login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'];

    //     $order_details = DB::table('fream_order')->select("fream_order.*",'users.*')
    //                             ->leftJoin('users','users.id','fream_order.user_id')
    //                             ->where('fream_order.user_id',$logged_in_user)
    //                             ->paginate(10);

    //   return view('backend.report_management.order_details')->with('order_details',$order_details);
    // }



    public function csv_export()
    {
      $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );
    $columns = array( 'First name',
            'Last name',
            'contact_number',
            'Date OF birth',
            'Email');

    $export = User::select('first_name','last_name','contact_number','dob','email')
                            ->where('user_role_id',4)->get();

   // return $export;
    $callback = function() use ($export, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($export as $review) {
            fputcsv($file, array($review->first_name, $review->last_name, $review->contact_number, $review->dob, $review->email));
        }
        fclose($file);
    };
    return response()->stream($callback, 200, $headers);
   }

   public function order_export()
    {

      $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );
    $columns = array( 'Order_id',
            'User Name',
            'Total Amount',
            'Add Promocode',
            'Discount',
            'Orignal Price',
            'Create date');

    $export = DB::table('fream_order')->select('fream_order.total_amount','fream_order.order_id','fream_order.created_at','fream_order.add_promocode','fream_order.promocode_discount','fream_order.orignal_price','users.first_name','frame_management.title')
                                          ->leftJoin('users','users.id','fream_order.user_id')
                                          ->leftJoin('frame_management','frame_management.id','fream_order.frame_id')
                                          ->get(); 

   // return $export;
    $callback = function() use ($export, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        
        foreach($export as $review) {
            fputcsv($file, array($review->order_id, $review->first_name, $review->total_amount,$review->add_promocode, $review->promocode_discount,$review->orignal_price, $review->created_at));
        }
        fclose($file);
    };
    return response()->stream($callback, 200, $headers);
   }

    // public function csv_export()
    // {
    //   $csv = new CsvExport;
    //   $csv->collection('user');
    //   return \Excel::download(new CsvExport, 'user.csv');
    // }

    // public function order_export()
    // { 
    //   $csv = new CsvExport;
    //   $csv->array();
    //   return \Excel::download(new CsvExport, 'order.csv');
    // }
}   
