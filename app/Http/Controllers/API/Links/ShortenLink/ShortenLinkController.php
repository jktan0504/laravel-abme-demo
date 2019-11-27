<?php

namespace App\Http\Controllers\API\Links\ShortenLink;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Links\ShortenLink;
use App\Http\Resources\Links\ShortenLink\ShortenLinkResource;

class ShortenLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('unique_code') != null) {
            $unique_code = $request->input('unique_code');

            $shortenlink =  ShortenLink::where('unique_code', $unique_code)->first();

            return $shortenlink;
        }
        return response()->json(['error' => 'code cannot be null'], Response::HTTP_NOT_ACCEPTABLE);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
