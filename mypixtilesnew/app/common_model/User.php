<?php
namespace App\common_model;
use Illuminate\Database\Eloquent\Model;
use App\common_model\Userrole;
use App\common_model\Module;
use App\common_model\Roleaction;
use App\common_model\Menu;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    protected $table='users';
    protected $timestamp=false;
    const UPDATED_AT='updated_date';
    const CREATED_AT='created_date';
    
    protected $hidden = [
        'password', 'remember_token','email_verified_at','password_reset_token','auth_key'
    ];

    public static function GetRoleDetail($id,$is_admin='N'){
        $route=\Route::currentRouteName();
        $route_=explode('.',$route)[0]??'';

        $menu_list = Menu::select('id','menuname','icon')->get();
        
        if($is_admin=='N' && auth()->user()->user_role_id!=1){
            $module_list=Userrole::
                        select('module.module_name','module.menu_name','menu.menuname','menu.id','menu.icon as menu_icon','module.icon as module_icon')
                       ->LeftJoin('role_action','userrole.id','role_action.role_id')
                       ->LeftJoin('module','role_action.module_id','module.id')
                       ->LeftJoin('menu','menu.id','module.menu_id')
                       ->where(['userrole.is_active'=>env('ACTIVE'),'userrole.id'=>$id])
                       ->groupBy('role_action.module_id')
                       ->having('module_name','!=','null')
                       ->orderBy('row_id', 'ASC')
                       ->get();
        }
        else{
            $module_list=Module::select('module.module_name','module.menu_name','menu.menuname','menu.id as menu_id','module.id as module_id','menu.icon as menu_icon','module.icon as module_icon')
                                //->LeftJoin('module_action','module.id','module_action.module_id')
                                ->LeftJoin('menu','module.menu_id','menu.id')
                                ->where(['module.is_active' => 'Y'])
                                //->groupBy('module.id')                                                            
                                ->get();
        }
        //dd($module_list);
            $menu=array();
            if($module_list){
          //        foreach ($menu_list as $key => $value) {
                //  $menu[$value->id][]=['id'=>$value->id,'menu_name'=>$value->menuname,'menu_icon'=>$value->icon,'submenu'=>[]];
                // }
                    foreach($module_list as $ke=>$val){
                        // $menu[$value->menu_id]['submenu'][] = ['module_id'=>$val->id,'module_name'=>$val->module_name,'module_icon'=>$val->icon];
                        /*$menu[$val->menu_id??$ke] = array('menu_id'=>$val->menu_id,'menu_name'=>$val->menuname,'menu_icon'=>$val->menu_icon,'submenu'=>[]);
                        $menu[$val->menu_id??$ke]['submenu'][][] = array('module_id'=>$val->module_id,'module_name'=>$val->module_name,'module_icon'=>$val->module_icon);*/
                        $selected='';
                        if(strtolower(str_replace(' ','-',$val->module_name))==$route_){
                            $selected='m-menu__item--open m-menu__item--expanded';
                        }else{
                            $selected='';
                        }
                        
                        $menu[$val->menuname??$ke][]=['module_name'=>$val->module_name,'icon'=>$val->menu_icon??$val->module_icon,'menu_name'=>$val->menu_name];
                        if($selected!=''){
                            $menu[$val->menuname??$ke]['selected']=$selected;
                        }                       
                    }
            }       
        return $menu;
    }

    public static function checkUserRole($role_name){
        $userrole = Userrole::where(['name'=>$role_name,'is_active'=>'Y'])->first();
        if($userrole){
            return $userrole->id;
        }else{
            return false;
        }
    }
}