<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\View\View;
use Session;

class Decoder extends BaseController
{
    public function msgDecoder()
    {

        if(isset($_GET["id"]) && isset($_GET["key"]))
        {
            $message = $_GET["id"];
            $key = $_GET["key"];
            if(isset($_GET["owner"]))
            {
                $ownerhash = $_GET["owner"];
                $trueownerhash = md5($message . $key);
                if($ownerhash == $trueownerhash)
                {
                    $owner = true;

                    $forDeleteId = $message;
                    $forDeleteKey = $key;
                    $forDeleteHash = $ownerhash;
                }
                else {
                    $owner = false;
                }
            } else {
                $owner = false;
            }
        } else {
            return view('encode');
        }

        $getMessage = DB::table('zinute')->where(['ID'=>$message])->first();
        
		// COUNT Fix
        //if(count($getMessage) > 0)
        if(!empty($getMessage))
        {
            
            if($getMessage->opened == 0)
            {
                $timeToAdd = 120 + $getMessage->time_limit; // +2 GTM
                $endTime = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . "+" . $timeToAdd ." minutes"));
                DB::table('zinute')->where(['ID'=>$message])->update(['opened' => 1, 'delete_date' => $endTime]);
                $getMessage = DB::table('zinute')->where(['ID'=>$message])->first();
            } else {
                if(strtotime(date($getMessage->delete_date)) < strtotime(date("Y-m-d H:i:s") . "+120 minutes"))
                {
                    DB::table('zinute')->where('ID', $message)->delete();
                    return view('encode', ['deleteAlert' => "true"]);
                }
            }
            
            $decrypted = Crypt::decryptString($getMessage->msg);
            $message = openssl_decrypt($decrypted ,"AES-128-ECB", $key);

            if($owner == true)
            {
                return view('decode', ['text' => $message, 'time' => $getMessage->delete_date, 'owner' => $owner, 'dId' => $forDeleteId, 'dKey' => $forDeleteKey, 'dHash' => $forDeleteHash]);
            }
            return view('decode', ['text' => $message, 'time' => $getMessage->delete_date, 'owner' => $owner]);
        } else {
            return view('encode', ['doesntExitAlert' => "true"]);
        }
    }
    public function deleteMsg(Request $req)
    {
        if(isset($_GET["delID"]) && isset($_GET["delKey"]))
        {
            if(isset($_GET["delown"]))
            {
                $message = $_GET["delID"];
                $key = $_GET["delKey"];
                $ownerhash = $_GET["delown"];

                $trueownerhash = md5($message . $key);
                if($ownerhash == $trueownerhash)
                {
                    DB::table('zinute')->where('ID', $message)->delete();
                }

                return view("encode", ['deleteAlert' => "true"]);
            }
        }
    }
}
?>