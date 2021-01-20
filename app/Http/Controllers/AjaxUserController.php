<?php

namespace App\Http\Controllers;

use App\Models\Ajax\AjaxUser;
use Illuminate\Http\Request;

class AjaxUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = AjaxUser::orderBy('id', 'desc')->paginate(8);

        return view('ajax.ajax-crud', $data);
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
        $user = AjaxUser::updateOrCreate(
            ['id' => $request->user_id],
            [
                'name' => $request->name,
                'email' => $request->email,
            ]);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajax\AjaxUser  $ajaxUser
     * @return \Illuminate\Http\Response
     */
    public function show(AjaxUser $ajaxUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajax\AjaxUser  $ajaxUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $user = AjaxUser::where($where)->first();

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajax\AjaxUser  $ajaxUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjaxUser $ajaxUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajax\AjaxUser  $ajaxUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AjaxUser::where('id', $id)->delete();

        return response()->json($user);
    }
}
