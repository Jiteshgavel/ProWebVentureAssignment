<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Dotlogics\Grapesjs\App\Editor\Config;

class PageController extends Controller
{
    use EditorTrait;


    public function pages(){

        $pages = Page::all();
        return view('pages',compact('pages'));
    }

    public function create(){
        $latestRecord = Page::latest()->first();
        if ($latestRecord) {
            $page = new Page();
            $page->title = 'Page '. $latestRecord->id+1;
            $page->save();
        } else {
            $page = new Page();
            $page->title = 'Page 1';
            $page->save();
        }

       return redirect()->route('editor',$page->id);
    }


    public function editor(Request $request,Page $page)
    {
        return $this->show_gjs_editor($request, $page);
    }
    
    public function delete($id){

        $page = Page::find($id);
        if($page){
            $page->delete();
            Session::flash('message', 'Page is deleted successfully!');
            return redirect()->back();
          
        }
       
        Session::flash('message', 'Some thing wrong please try again later!');
        return redirect()->back();
    }

    protected function show_gjs_editor(Request $request, $model)
    {
        $editorConfig = app(Config::class)->initialize($model);
        return view('laravel-grapesjs::edittor', compact('editorConfig', 'model'));
    }


    public function view($id){
        $page = Page::find($id);
        return view('pages_view',compact('page'));
    }
        
}