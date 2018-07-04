<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeSectionRequest;
use DB;
use App\Section;
use App\book;
class sectioncontroller2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function _construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $date=date('Y-m-d');
        $time=date('H:i:s');
        /*
        $sections=['art'=>'art.jpg','mechanic'=>'mechanic.jpg','history'=>'history.jpg','programming'=>'programming.jpg','comic'=>'comic.jpg','civil'=>'civil.jpg'];*/

         //$sections=DB::table('section')->get();
          $sections=Section::all();
        return view('libaryViewContainer.library',compact('sections','date','time'));
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
      //  $this->validate($request,['section_name'=>'requried|unique:section,section_name|max:30','image_name'=>'mimes:png|max:1024']);
        //store the new section to the db.
        $section_name=$request->input('section_name');
        $file=$request->file('image');
        //path default in public im image
        $descriptionPath='image';
        //file name and formate
        $filename=$file->getClientOriginalName();
        $file->move($descriptionPath,$filename);
       // DB::table('section')->insert(['section_name'=>$section_name,'image_name'=>$filename]);
        $new_section=new Section;
        $new_section->section_name=$section_name;
        $new_section->image_name=$filename;
        $new_section->save();
        session()->push('m','sucess');
        session()->push('m','section create sucessfully');
        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $date=date('Y-m-d');
        $time=date('H:i:s');
        $section=Section::find($id);
       /* $all_books=DB::table('section')
                      ->join('books','section.id','=','books.section_id')
                      ->where('section.id',$id)
                      ->get();*/
                              // dd($all_books);
        $all_books=$section->books;
        $array_of_author=[];
        $i=0;
        foreach ($all_books as $book) {
            # code...
            $array_of_author=array_add($array_of_author,$i,
            /*DB::table("books")
            ->join("books_authors_relationship","books.id","=","books_authors_relationship.book_id")
            ->join("authors","books_authors_relationship.id","=","authors.id")
            ->where("books.id",$book->id)
            ->select("authors.first_name","authors.id")
            ->get()*/
          $book->authors()->select("authors.first_name","authors.id")->get());
            $i++;
            
        }

    return view('libaryViewContainer.book',compact('section','all_books','date','time','array_of_author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $section_name=$request->input('section_name');
        //DB::table('section')->where('id',$id)->update(['section_name'=>$section_name]);
        $section=Section::find($id);
        $section->section_name=$section_name;
        $section->save();
        session()->push('m','sucess');
        session()->push('m','section update sucessfully!!');
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        //delete the section with id=$id from db.
        //DB::table('section')->where('id',$id)->delete();
        Section::destroy($id);
        session()->push('m','danger');
        session()->push('m','section delete temporary!!');
        return redirect('admin');

    }
    public function admin()
    {
         //$sections=DB::table('section')->withTrashed()->get();
         $date=date('Y-m-d');
         $time=date('H:i:s');
        // dd($sections);
         $sections=Section::withTrashed()->get();
         return view('libaryViewContainer.admin',compact('sections','date','time'));
    }
    public function restore($id)
    {
        $section=Section::onlyTrashed()->find($id);
        $section->restore();
        session()->push('m','info');
        session()->push('m','section restored sucessfully!!');
        return redirect('admin');
    }
      public function deleteForever($id)
    {
        $section=Section::onlyTrashed()->find($id);
        $section->forceDelete();
        session()->push('m','danger');
        session()->push('m','section dleted sucessfully!!');
        return redirect('admin');
    }
}
