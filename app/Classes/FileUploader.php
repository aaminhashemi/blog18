<?php


namespace App\Classes;


use Illuminate\Support\Facades\File;

class FileUploader
{
    public static function uploader($request,$path)
    {
        $file=$request->file('file');
        $extension=$file->getClientOriginalExtension();
        $fileName = time().rand(10000,99999).'.'.$extension;
        $file->move($path,$fileName);
        return $path.$fileName;
    }
}
