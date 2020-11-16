<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class FilterPermissionService
{
    public function checkPermission($request, $ip)
    {
        $response = null;
        if ($request->session()->get('ip') && $request->session()->get('ip') == $ip) {
            if (strtotime($request->session()->get('time')) < strtotime(Carbon::now('GMT+3'))) {
                $request->session()->forget('ip');
                $request->session()->forget('time');
                Session::forget('errorMessage');
                $addTime = (Carbon::now('GMT+3')->addSeconds(6));
                $request->session()->put('ip', $ip);
                $request->session()->put('time', $addTime);
                $response = true;
            } else {
                Session::flash('errorMessage', 'You must wait 6 secods until the next sorting');
                $response = false;
            }
        } else {
            Session::forget('errorMessage');
            $addTime = (Carbon::now('GMT+3')->addSeconds(6));
            $request->session()->put('ip', $ip);
            $request->session()->put('time', $addTime);
            $response = true;
        }
        return $response;
    }
}
