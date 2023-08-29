<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Site;
use Illuminate\View\View;

class SiteController extends Controller
{
    private const PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sites = Site::orderBy('domain')->paginate(static::PER_PAGE);

        $page = max(request()->input('page', 1) - 1, 0);

        return view('sites.index',compact('sites'))
            ->with('i', $page * static::PER_PAGE);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'domain' => 'required',
            'access' => 'required|integer|min:1|digits_between: 1,5',
        ]);

        Site::create($request->all());

        return redirect()->route('sites.index')->with('success', 'Site added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site): View
    {
        return view('sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site): View
    {
        return view('sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'domain' => 'required',
            'access' => 'required|integer|min:1|digits_between: 1,5',
        ]);

        $site = Site::find($id);
        $input = $request->all();
        $site->update($input);

        return redirect()->route('sites.index')->with('success', 'Site updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Site::destroy($id);

        return redirect()->route('sites.index')->with('success', 'Site deleted!');
    }
}
