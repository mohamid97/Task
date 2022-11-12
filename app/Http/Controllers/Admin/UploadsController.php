<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadsController extends Controller
{
  public function create(){
      $users = User::all();
      return view('admin.uploads.create' , compact('users'));
  }
  public function store(Request $request){

      $request->validate([
          'user'=>'required',
          'zips*'=>'required|mimes:zip|max:1000'
      ]);
      foreach ($request->zips as $file) {
          $file_name = $file->getClientOriginalName();
          $size = $file->getSize();
          $type = $file->getClientOriginalExtension();
          $file->move(public_path('uploads'), $file_name);
          $zip = new \ZipArchive();
          if ($zip->open(public_path('uploads/'.$file_name)) === TRUE) {
              $zip->extractTo(public_path('uploads'));
              $zip->close();
              // store file at database
              $this->store_file($file_name , $type , $size , $request->user);
          }
       }
      return redirect()->route('users.index')->with('success','Zip Files Added Successfully!');



  }

    public function store_file($file_name , $type , $size , $user):void{
        File::create([
            'user_id'=>$user,
            'file_name'=>$file_name,
            'file_type'=>$type,
            'file_size'=>$size,
        ]);
    }

    public function delete($id){
        $files = File::where('user_id' , $id)->get();
        if ($files){
          foreach ($files as $file){
              if(file_exists(public_path('uploads/') . $file->file_name)){
                  unlink(public_path('uploads/') . $file->file_name);
              }
              $file->delete();
          }
        }

        return redirect()->route('users.index')->with('success','Zip Files deleted Successfully!');
    }
}
