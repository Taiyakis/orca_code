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

class Encoder extends BaseController
{
    public function msgEncode(Request $req)
    {
        $msg = $req->input('message');
        $time = $req->input('time');
        $viewUrl =  url()->full();
        $ownerUrl = $viewUrl;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $key = md5($randomString);
        $msg = openssl_encrypt($msg,"AES-128-ECB", $key);


        $encrypted = Crypt::encryptString($msg);

        $toUrl = md5($encrypted);
        DB::table('zinute')->insert(
            ['ID' => $toUrl, 'msg' => $encrypted, 'time_limit' => $time, 'opened' => 0]
        );

        $ownerKey = md5($toUrl . $key);
        
        $viewUrl .= "/index?id=" . $toUrl . "&key=" . $key;
        $ownerUrl .= "/index?id=" . $toUrl . "&key=" . $key . "&owner=" . $ownerKey;
        return view('encode', ['viewUrl' => $viewUrl, 'ownerUrl' => $ownerUrl]);
    }
}
?>