<?php

namespace App\Http\Controllers;

use App\Models\Ajax\Fullcalendar;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
//use Redirect,Response;

class FullCalendarEventMasterController extends Controller
{
    public function index(Request $request)
    {
//        $calendar = Fullcalendar::find(3);
//        $calendar = Fullcalendar::stock()->get();
        $calendar = Fullcalendar::get();
//        dd($calendar[1]);
//        dd($calendar[0]->append('stock_number')->toArray());
//        $d = $calendar[1]->append('stock_number')->toArray();
//        dd(response()->json($d));


////        dd($item);
////        dd($item[0]->title);
//        $collection = collect([
//            ['name' => '山田', 'age' => 22],
//            ['name' => '鈴木', 'age' => 25],
//            ['name' => '佐藤', 'age' => 18],
//            ['name' => '田中', 'age' => 30],
//            ['name' => '山本', 'age' => 16]
//        ]);

//        $multiplied = $collection->map(function($item, $key){
//
//            $item['age_unit'] = $item['age'] .'才';
////            dd($item);
////            Debugbar::info($item);
//
//        });

//        foreach ($calendar as $key => $cal) {
//            dd(response()->json(['stock_number' => $cal->title]));
//        }

//        dd($calendar);
//        dd($calendar[0]->stock_number);
//        $user = \App\User::find(1);
//        dd($user->name);
//        $calendar->map(function ($item) {
//                $item['stock_number'] = $item['title'];
//
//                return $item;
//            });


//        dd(response()->json(['stock_number' => $calendar->title]));
        if(request()->ajax())
        {
            $start = (!empty($request->start)) ? ($request->start) : ('');
            $end = (!empty($request->end)) ? ($request->end) : ('');
//            $data = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'start', 'end']);
            $data = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();
//        dd($calendar);
//        dd(Fullcalendar::stockNumber());

//            foreach ($data as $key => $cal) {
//                $data2 = collect($data[$key]->setAppends(['stock_number'])->toArray());
////                dd(collect($cal->setAppends(['stock_number'])->toArray()));
//////                return response()->json(['stock_number' => $cal->title, 'start' => $cal->start, 'end' => $cal->end]);
////        dd($cal->stock_number);
//////                return response()->json(['stock_number' => $cal->title, 'start' => $cal->start, 'end' => $cal->end]);
//            dd($data2);
//             return response()->json($data2);
//            }
//                return response()->json(['stock_number' => $data->title, 'start' => $data->start, 'end' => $data->end]);

//        dd($data[0]->setAppends(['stock_number'])->toArray());
//            return response()->json($data2);
//            return response()->json($item);
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
