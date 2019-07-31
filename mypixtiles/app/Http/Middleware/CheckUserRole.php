<?php

namespace App\Http\Middleware;
use App\common_model\User;

use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if(\Auth::user()->is_active!=env('ACTIVE')){
        //     return redirect('logout');
        // }
        $allowaction=array('data');
        $allowcontroller=array('home','dashboard','changePassword','edit-profile');
        $action=explode('/',$request->getPathInfo());        
        // $flag=false;
        // if(in_array($action[1], $allowcontroller)){
        //     $flag=false;
        // }else if(in_array($action[2]??'', $allowaction)){
        //     $flag=false;
        // }

        if(in_array($action[1], $allowcontroller)==false && in_array(($action[2]??''), $allowaction)==false){
            if($action[2]=='store'){
                $action[2]='create';
            }

            else if($action[2]=='update'){
                $action[2]='edit';

            }else if($action[2]=='index'){
                $action[2]='list';
            }
            $user_id=\Auth::user()->id;
            $role=User::SELECT('module_name','action_name')
            ->join('userrole','users.user_role_id','userrole.id')
            ->join('role_action','userrole.id','role_action.role_id')
            ->join('module','role_action.module_id','module.id')
            ->join('action','role_action.action_id','action.id')
            ->where(['userrole.is_active'=>env('ACTIVE'),'role_action.is_active'=>env('ACTIVE'),'module_name'=>str_replace('-',' ', $action[1]),'action_name'=>$action[2],'users.id'=>$user_id])
            ->count();   

            if($role>0 || \Auth::user()->is_admin=='Y'){
            return $next($request);
            }else{
                return redirect()->back()->with('error','You are not authorized to perform this operation');
            }
        }else{
            return $next($request);
        }
        
        
    }
}
