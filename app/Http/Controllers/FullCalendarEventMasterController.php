<?php

namespace App\Http\Controllers;

use App\Models\Ajax\Fullcalendar;
use Illuminate\Http\Request;
//use Redirect,Response;

class FullCalendarEventMasterController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $data = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);

//            return response()->json($data);
            return response()->json($data);
        }
        return view('fullcalendar2.fullcalender');
    }

    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Fullcalendar::insert($insertArr);
        return response()->json($event);
    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Fullcalendar::where($where)->update($updateArr);
        return response()->json($event);
    }

    public function destroy(Request $request)
    {
        $event = Fullcalendar::where('id',$request->id)->delete();
        return response()->json($event);
    }

}
