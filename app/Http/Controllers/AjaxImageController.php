<?php

namespace App\Http\Controllers;

use App\Models\Ajax\AjaxImage;
use Illuminate\Http\Request;
use Validator;

class AjaxImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxImageUpload()
    {
        return view('ajax.image-upload');
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
     * @param  \App\Models\Ajax\AjaxImage  $ajaxImage
     * @return \Illuminate\Http\Response
     */
    public function show(AjaxImage $ajaxImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajax\AjaxImage  $ajaxImage
     * @return \Illuminate\Http\Response
     */
    public function edit(AjaxImage $ajaxImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajax\AjaxImage  $ajaxImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjaxImage $ajaxImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajax\AjaxImage  $ajaxImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjaxImage $ajaxImage)
    {
        //
    }
}
