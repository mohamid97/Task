<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $files = File::all();
      return view('users.uploads.index' , compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate zip file
        $request->validate([
            'file'=>'required|mimes:zip|max:1000'
        ]);
        dd($request->file);
        // unzip and add file to public directory then add record to database
        if($this->unzip_file($request)){
            return redirect()->route('upload-files.index')->with('success','Zip File Added Successfully!');
        }

    }
    /**
     *
     * unzip function
     */
    public function unzip_file(Request $request):bool{
        DB::beginTransaction();
        $file_name = $request->file->getClientOriginalName();
        $size = $request->file->getSize();
        $type = $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $file_name);
        $zip = new \ZipArchive();
        if ($zip->open(public_path('uploads/'.$file_name)) === TRUE) {
            $zip->extractTo(public_path('uploads'));
            $zip->close();
            // store file at database
            $this->store_file($file_name , $type , $size);
            DB::commit();
            return true;
        }

    }
    /**
     * store database
     * add file data at database
     */

    public function store_file($file_name , $type , $size):void{
        File::create([
            'user_id'=>auth()->user()->id,
            'file_name'=>$file_name,
            'file_type'=>$type,
            'file_size'=>$size,
        ]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)

    {
        $file = File::findOrFail($file);
        $file->delete();
        if(file_exists(public_path('uploads/') . $file->file_name)){
            unlink(public_path('uploads/') . $file->file_name);
        }
        return redirect()->route('upload-files.index')->with('success','Zip File deleted Successfully!');

    }
}
