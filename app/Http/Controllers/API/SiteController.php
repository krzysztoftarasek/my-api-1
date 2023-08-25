<?php

namespace App\Http\Controllers\API;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Resources\Site as SiteResource;
use App\Http\Controllers\API\BaseController as BaseController;

class SiteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();
        return $this->sendResponse(SiteResource::collection($sites), 'Sites Retrieved Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'required',
            'access' => 'required|integer|min:1|digits_between: 1,5',
        ]);

        $site = Site::create($request->all());

        return $this->sendResponse(new SiteResource($site), 'Site Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = Site::find($id);

        if (is_null($site)) {
            return $this->sendError('Site not found.');
        }

        return $this->sendResponse(new SiteResource($site), 'Site Retrieved Successfully.');
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
        $request->validate([
            'domain' => 'required',
            'access' => 'required|integer|min:1|digits_between: 1,5',
        ]);

        $site = Site::find($id);

        if (is_null($site)) {
            return $this->sendError('Site not found.');
        }

        $site->domain = $request->domain;
        $site->domain = $request->domain;
        $site->save();

        return $this->sendResponse(new SiteResource($site), 'Site Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site = Site::find($id);

        if (is_null($site)) {
            return $this->sendError('Site not found.');
        }

        $site->delete();

        return $this->sendResponse([], 'Site Deleted Successfully.');
    }
}