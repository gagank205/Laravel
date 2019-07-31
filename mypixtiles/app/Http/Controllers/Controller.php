<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\common_model\UserDevice;
use App\common_model\User;
use App\common_model\SiteConfiguration;
use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Site Confing call
    public function getSiteconfigValueByKey($key){
    	$model = SiteConfiguration::where(['config_key' => $key, 'is_active' => 'Y'])->first();
    	if(!empty($model)){
    		return $model->config_value_en;
    	} else {
    		return 'Undefine Key';
    	}
    }

/*    public function SendSMS($to_number,$sms_body)
    {
    	try{
    		$account_sid = getenv("TWILIO_SID");
	        $auth_token = getenv("TWILIO_AUTH_TOKEN");
	        $twilio_number = getenv("TWILIO_NUMBER");
            
	        $client = new Client($account_sid, $auth_token);
	        $res=$client->messages->create($to_number, ['from' => $twilio_number, 'body' => $sms_body]);
	        return $res;
		}catch(\Twilio\Exceptions\RestException $e){
			dd($e);
		}
    }*/

    function SendSms($phone_number,$body){
        try{
            $sid =env('TWILIO_SID');
            $token =env('TWILIO_TOKEN');
            $number=env('TWILIO_NUMBER');
            
            $client = new Client($sid, $token);

            $sms_response=$client->messages->create($phone_number, 
                ['from'=>$number,'body'=>$body]
            );
            return $sms_response;
        }
        catch(\Services_Twilio_RestException $e ){
            return false;
        }
        catch(Exception $ex){
            return false;
        }
    }

    function UserAccess($user_id,$device_id,$access_token){
        try{
            $user_device=UserDevice::where(['user_id'=>$user_id,'user_device_id'=>$device_id,'access_token'=>$access_token,'is_login'=>'Y'])
            ->where('access_token','!=','')
            ->count();
            $user=User::where(['id'=>$user_id,'is_active'=>env('ACTIVE')])->count();

            if($user_device>0 && $user>0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $ex){
            return false;
        }
    }
}
