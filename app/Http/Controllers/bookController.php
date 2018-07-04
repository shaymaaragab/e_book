<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use  App\book;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        DB::transaction(function() use($request){
        $author_id=1;
        $another_author=$request->another_author;
        $author2=DB::table("authors")
             ->where("first_name",$another_author)
             ->select("id")
             ->first();
        $book_title=$request->book_title;
        $book_edition=$request->book_edition;
        $book_description=$request->book_dscription;
        $section_id=$request->section_id;
        $ID_Book=DB::table("books")
              ->insertGetId(["book_title"=>$book_title,"book_edition"=>$book_edition,"book_dscription"=>$book_description,"section_id"=>$section_id]);
        if($author2!=null){
            $author2_id=$author2->id;
            DB::table("books_authors_relationship")
            ->insert(["book_id"=>$ID_Book,"author_id"=>$author_id],
                ["book_id"=>$ID_Book,"author_id"=>$author2_id]);

        }
        else{
            DB::table("books_authors_relationship")
            ->insert(["book_id"=>$ID_Book,"author_id"=>$author_id]);

        }
    });
        $section_id=$request->section_id;
        // return redirect()->route('library.show',$section_id);
         return redirect("library/".$section_id."/show");
        // return redirect()->back();

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
        $book_title=$request->book_title;
        $book_edition=$request->book_edition;
        $book_description=$request->book_dscription;
        $section_id=$request->section_id;
        DB::table('books')
        ->where("id",$id)
        ->update(['book_title'=>$book_title,'book_edition'=>$book_edition,'book_dscription'=>$book_description]);
        return redirect("library/".$section_id."/show");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
        $section_id=$request->section_id;
        DB::table('books')->where("id",$id)->delete();
       return redirect("library/".$section_id."/show");
    }
    public function summary(){
        $results=book::with('section')->with('authors')->get();
        return view('summary',compact('results',$results));
    }
}
