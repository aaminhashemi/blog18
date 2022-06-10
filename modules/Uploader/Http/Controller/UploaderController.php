<?php

namespace Uploader\Http\Controller;

use Uploader\Repositories\UploaderRepository;
use App\Http\Controllers\Controller;

class UploaderController extends Controller
{
    public static $min_number=10000;
    public static $max_number=99999;
    public $repository;
    public function __construct(UploaderRepository $uploaderRepository)
    {
        $this->repository = $uploaderRepository;
    }
    public function uploader($request,$path)
    {
        $this->repository->resizeUploader($request,$path);
        /*$file=$request->file('file');
        $extension=$file->getClientOriginalExtension();
        $fileName = time().rand(self::$min_number,self::$max_number).'.'.$extension;
        $file->move($path,$fileName);
        return $path.$fileName;*/
    }
}
