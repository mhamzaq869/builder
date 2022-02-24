<?php

namespace Code\Builder\Http\Controllers;

use App\Http\Controllers\Controller;
use Code\Builder\Models\Page;
use Code\Builder\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::where('status',1)->get();
        return view('Builder::page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::all();
        return view('Builder::page.create',compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $page = Page::create([
                    'user_id' => Auth::user()->id ?? 0,
                    'title' => $request->title,
                    'decription' => $request->decription,
                    'page_url' => $request->page_url,
                    'meta_title' => $request->decription,
                    'meta_description' => $request->meta_description,
                    'keywords' => $request->keywords,
                    'status' => 1,
                ]);

        // Template::find($request->temp_id)->update([
        //     'page_id' => $page->id,
        // ]);


        return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('status',1)->where('page_url',$slug)->first();
        return view('Builder::page.show',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $templates = Template::all();
        return view('Builder::page.edit',compact('page','templates'));
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
        Page::find($id)->update([
            'user_id' => Auth::user()->id ?? 0,
            'title' => $request->title,
            'decription' => $request->decription,
            'page_url' => $request->page_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'keywords' => $request->keywords,
            'status' => 1,
        ]);

        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id)->delete();
        return redirect()->route('page.index');
    }
}
