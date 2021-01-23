<?php

namespace App\Http\Controllers;

use App\Models\Ajax\Fullcalendar;
use App\Models\Ajax\Reservation;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
//use Redirect,Response;

class FullCalendarEventMasterController extends Controller
{
    public function index(Request $request)
    {
        // 未使用
//        $calendar = Fullcalendar::whereMonth('start', '01')->get();

        // 成功 各要素に「color」を追加, 「set_number」を上書き
        $k = Reservation::select('id','title as stock_number', 'start', 'end')->get();
        $array = $k->toArray();
        $add_txt = '予約：';
        $color = array('color' => '#fae9e8');

        $test = collect(array_map(function ($k) use ($add_txt, $color) {
            $s = $add_txt . $k['stock_number'];
            $new_title = array('stock_number' => $s);

//            array_push($s);
            return array_merge($k, $new_title, $color);
        }, $array));
//
        dd($test, $array);
//      ----

        // 成功 各要素に「color」のみを追加
        $k = Reservation::select('id','title as stock_number', 'start', 'end')->get();
        $array = $k->toArray();
        $color = array('color' => '#fae9e8');

        $test = collect(array_map(function ($k) use ($color) {
            return array_merge($k, $color);
        }, $array));

        dd($test);
//      ----

//        dd(collect($test));

        if(request()->ajax())
        {
            $start = (!empty($request->start)) ? ($request->start) : ('');
            $end = (!empty($request->end)) ? ($request->end) : ('');
//            $data = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'start', 'end']);
//            $data = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();

            $data = Reservation::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();

            $data->put('color', '#fae9e8');
//            $data->merge(['color' => '#fae9e8']);
//            $data->union(['color' => '#fae9e8']);

            return response()->json($data);
        }
        return view('fullcalendar2.fullcalender');
    }

    public function reservation(Request $request)
    {
        if ($request->ajax()) {
            $start = (!empty($request->start)) ? ($request->start) : ('');
            $end = (!empty($request->end)) ? ($request->end) : ('');
            $data = Reservation::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();
//            $data .= {color: "#fae9e8"};
            $data->put('color', '#fae9e8');
            dd($data);

            return response()->json($data);
        }

    }

    public function create(Request $request)
    {
        $insertArr = [ 'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Fullcalendar::create($insertArr);
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
