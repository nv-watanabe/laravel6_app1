<?php

namespace App\Http\Controllers;

use App\Models\Ajax\Fullcalendar;
use App\Models\Ajax\Reservation;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Validator;
//use Redirect,Response;

class FullCalendarEventMasterController extends Controller
{
    public function index(Request $request)
    {
        // 未使用
//        $calendar = Fullcalendar::whereMonth('start', '01')->get();

        if(request()->ajax())
        {
            $start = (!empty($request->start)) ? ($request->start) : ('');
            $end = (!empty($request->end)) ? ($request->end) : ('');

            // old Data
//            $data = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();

            // Stock
            $getStock = Fullcalendar::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();
            $arrayStock = $getStock->toArray();
            $stockLabel = '在庫：';
            $stockColor = array('color' => '#fcf7e6');

            $Stock = array_map(function ($getStock) use ($stockLabel, $stockColor) {
                $title = $stockLabel . $getStock['title'];
                $stockTitle = array('title' => $title);

                return array_merge($getStock, $stockTitle, $stockColor);
            }, $arrayStock);

//            dd($Stock);

            // Reservation
            $getReservation = Reservation::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get();
            $arrayReservation = $getReservation->toArray();
            $reservationLabel = '予約：';
            $reservationColor = array('color' => '#fae9e8');

            $Reservation = array_map(function ($getReservation) use ($reservationLabel, $reservationColor) {
                $title = $reservationLabel . $getReservation['title'];
                $reservationTitle = array('title' => $title);

                return array_merge($getReservation, $reservationTitle, $reservationColor);
            }, $arrayReservation);

            // Stock + Reservation
            $data = collect(array_merge($Stock, $Reservation));

            return response()->json($data);
        }
        return view('fullcalendar2.fullcalender');
    }

    public function create(Request $request)
    {
//        dd($request->all());
        $insertArr = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Fullcalendar::create($insertArr);

        return response()->json($event);
    }

    public function getData($id)
    {
        $data = Fullcalendar::find($id);

        return response()->json($data);
    }

    public function stockUpdate(Request $request)
    {
//            dd($request->all());
//        if($request->ajax()) {
            $rules = [
                'stock_number' => 'required',
            ];

            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $event = Fullcalendar::where('id', $request->stock_id)->update([
                'title' => $request->stock_number,
            ]);

        return response()->json($event);
//        }
//        $data = Fullcalendar::find($id);

    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = [
            'title' => mb_substr($request->title, 3),
            'start' => $request->start,
            'end' => $request->end
        ];
        $event  = Fullcalendar::where($where)->update($updateArr);

        return response()->json($event);
    }

    public function destroy(Request $request)
    {
        $event = Fullcalendar::where('id',$request->id)->delete();
        return response()->json($event);
    }

}
