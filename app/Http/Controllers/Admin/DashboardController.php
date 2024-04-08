<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Location;
use DataTables;

class DashboardController extends Controller
{
    public function index(Request $request){

        $date = $request->last_date ?? 7;
        $dateArr = array();
        $lastDaysArr = array();
        $lastDays = Carbon::now()->subDays($date)->format('Y-m-d');
        $now = time();
        $webViews =array();
        $period = CarbonPeriod::create($lastDays, Carbon::now()->format('Y-m-d'));
        if($request->ajax()) {
                foreach ($period as $data) {
                    $dateArr[] = $data->format('m/d');
                    $lastDaysArr[] = $data->format('Y-m-d');
                }

                foreach ($lastDaysArr as $data) {
                    $webViews[] = ActivityLog::whereDate('created_at', $data . ' 00:00:00')
                        ->distinct('ip')
                        ->count();
                    $viewSum = array_sum($webViews);
                }

                
          

                return  response()->json(['webViews' => $webViews, 'dateArr' => $dateArr]);
        }
        
        return view('admin.dashboard.index',compact('webViews','dateArr'));
    }


    public function mostResentViewed(Request $request){

        if ($request->ajax()) {

            $data = ActivityLog::whereNotNull('product_id')->distinct('ip')->with('product')->latest()->take(5)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    return $row->product ? $row->product->name : '';
                })
                ->addColumn('country', function ($row) {
                    $location =  Location::get($row->ip);
                     return $location ? $location->countryName : '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
