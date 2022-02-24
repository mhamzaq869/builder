<?php

namespace Code\Builder\Http\Controllers;

use App\Http\Controllers\Controller;
use Code\Builder\Models\Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();
        return view('Builder::templates.index',compact('templates'));
    }

    public function show(Request $request)
    {
        $temp = Template::all();
        return response()->json([
            'status' => 200,
            'data' => $temp,
        ]);
    }

    public function store(Request $request)
    {
        if($request->hasFile('thumbnail')){
            $filename = 'storage/template/'.$request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('template/',$request->thumbnail->getClientOriginalName(),'public');
            $request->thumbnail = $filename;
        }

        Template::create([
            'user_id' => Auth::user()->id ?? 0,
            'title' => $request->title,
            'picture' => $request->thumbnail,
        ]);

        return redirect()->route('templates');
    }

    public function update(Request $request,$id)
    {
        File::delete(Template::find($id)->picture ?? '');
        if($request->hasFile('thumbnail')){
            $filename = 'storage/template/'.$request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('template/',$request->thumbnail->getClientOriginalName(),'public');
            $request->thumbnail = $filename;
        }

        Template::find($id)->update([
            'user_id' => Auth::user()->id ?? 0,
            'title' => $request->title,
            'picture' => $request->thumbnail,
        ]);

        return redirect()->route('templates');
    }

    public function design($id)
    {
       $temp =  Template::find($id);
       return view('Builder::editor',compact('temp'));
    }

    public function storeDesign(Request $request)
    {
       try{
            $temp = Template::find($request->id);
            $temp->content = $request->html;
            $temp->save();

            return response()->json([
                'status' => 200,
                'message' => 'Your Template Design has been Saved Successfully',
            ]);

       }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
       }

    }

    public function activateTemplate(Request $request)
    {
        try{
            Template::where('page_id',$request->page_id)->update(['page_id' => null]);
            Template::find($request->id)->update(['page_id' => $request->page_id]);

            return response()->json([
                'status' => 200,
                'message' => 'You have activated this template',
            ]);

       }catch(Exception $e){
            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ]);
       }
    }
}
