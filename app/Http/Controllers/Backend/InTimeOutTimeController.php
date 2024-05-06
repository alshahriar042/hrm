<?php

namespace App\Http\Controllers\Backend;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class InTimeOutTimeController extends Controller
{
    private function deviceName()
    {
        $browser = Agent::browser();
        return $browser."-".Agent::version($browser);
    }

    private function getLocation()
    {
        // $ip = $request->ip();
        $ip = '203.96.226.122'; /* Static IP address */
        return Location::get($ip);
    }

    public function setInTime(Request $request)
    {
        // return $request->all();

        try {
            Attendance::create([
                'employee_id' => Auth::id(),
                'in_time' => date("H:i"),
                'in_region_name' => $this->getLocation()->regionName,
                'in_city_name' => $this->getLocation()->cityName,
                'in_zip_code' => $this->getLocation()->zipCode,
                'in_latitude' => $this->getLocation()->latitude,
                'in_longitude' => $this->getLocation()->longitude,
                'in_device_name' => $this->deviceName(),
            ]);

            $attendence       = Attendance::where('employee_id', Auth::id())->whereDate('created_at', date('Y-m-d'))->orderBy('id','DESC')->first();

            return response()->json(['status' => 1,'message'=>"Checked In Time Successfully.",'attendence'=>$attendence]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0,'message'=>"Checked In Time Failed."]);
        }

        // notify()->success('Checked In Time Successfully', 'Success');
        // return back();
    }

    public function setOutTime(Request $request)
    {
        try {
            $attendence = Attendance::where('employee_id', Auth::id())->whereDate('created_at', date('Y-m-d'))->orderBy('id','DESC')->first();
            $attendence->update([
                'out_time' => date("H:i"),
                'out_region_name' => $this->getLocation()->regionName,
                'out_city_name' => $this->getLocation()->cityName,
                'out_zip_code' => $this->getLocation()->zipCode,
                'out_latitude' => $this->getLocation()->latitude,
                'out_longitude' => $this->getLocation()->longitude,
                'out_device_name' => $this->deviceName(),
            ]);

            // notify()->success('Checked Out Time Successfully', 'Success');
            // return back();
            return response()->json(['status' => 1,'message'=>"Checked Out Time Successfully.",'attendence'=>$attendence]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0,'message'=>"Checked Out Time Failed."]);
        }
    }
}
