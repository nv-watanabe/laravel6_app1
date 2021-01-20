<?php

namespace App\Http\Controllers;

use App\Models\Ajax\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function setEvents(Request $request)
    {

//        $start = $this->formatDate($request->all()['start']);
        $start = '2021-01-01';
//        $end = $this->formatDate($request->all()['end']);
        $end = '2021-12-31';
//        //表示した月のカレンダーの始まりの日を終わりの日をそれぞれ取得。
//
        $events = Event::select('event_id', 'title', 'date')->whereBetween('date', [$start, $end])->get();
        //カレンダーの期間内のイベントを取得

        $newArr = [];
        foreach($events as $item){
            $newItem["id"] = $item["event_id"];
            $newItem["title"] = $item["title"];
            $newItem["start"] = $item["date"];
            $newArr[] = $newItem;
        }
        //新たな配列を用意し、 EventsObjectが対応している配列にキーの名前を変更する

        echo json_encode($newArr);
        //json形式にして出力
    }

        public function formatDate($date){
        return str_replace('T00:00:00+09:00', '', $date);
    }
        // "2019-12-12T00:00:00+09:00"のようなデータを今回のDBに合うように"2019-12-12"に整形

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEvent(Request $request)
    {
        $data = $request->all();
        $event = new Event();
        $event->event_id = $this->generateId();
        //僕はmodel.phpでuuidを作成する関数を書いていましたが、みなさんはご自由に。
        $event->date = $data['date'];
        $event->title = $data['title'];
        $event->save();

        return response()->json(['event_id' => $event->event_id ]);
    }
    // ajaxで受け取ったデータをデータベースに追加し、今度はidを返す。

    public function editEventDate(Request $request){
        $data = $request->all();
        $event = Event::find($data['id']);
        $event->date = $data['newDate'];
        $event->save();
        return null;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajax\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajax\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajax\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajax\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
