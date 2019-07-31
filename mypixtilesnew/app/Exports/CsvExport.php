<?php

namespace App\Exports;
use App\User;
use DB;
use App\common_model\FrameOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\fromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CsvExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collections($data="")
    {
    	$export = User::select('first_name','last_name','contact_number','dob','email')
                            ->where('user_role_id',4)->get();

    	return $export;
    }
    public function headings(): array
    {
        return [
            'First name',
            'Last name',
            'contact_number',
            'Date OF birth',
            'Email',
        ];
    }

    public function orders()
    {

      
        $export = DB::table('fream_order')->select('fream_order.total_amount','fream_order.order_id','fream_order.created_at','users.first_name','frame_management.title')
                                          ->leftJoin('users','users.id','fream_order.user_id')
                                          ->leftJoin('frame_management','frame_management.id','fream_order.frame_id')
                                          ->get()->toArray(); 

        // //  dd($export)  ;   
        //     $export = User::select('first_name','last_name','contact_number','dob','email')
        //                     ->where('user_role_id',4)->get();

        return $export;                             
       // return $export;
         
    }

}
