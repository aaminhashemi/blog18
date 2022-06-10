<?php


namespace Category\Repositories;


use Category\Models\Category;
use Uploader\Http\Controller\UploaderController;
use Uploader\Repositories\UploaderRepository;
use Uploader\Services\UploaderService;
use App\Classes\FileUploader;
use App\Constants\Constants;

class CategoryRepository
{
    public function allCategories()
    {
        return Category::all();
    }

    public function findParents()
    {
        return Category::whereNull('category_id')->get();
    }

    public function findParentsExcept($category)
    {
        return Category::where('id', '!=', $category->id)->whereNull('category_id')->get();
    }

    public function saveCategory($request,$path,$width=null,$height=null)
    {
        return Category::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => UploaderService::UploadService($request, $path, $width , $height),
        ]);
    }

    public function updateCategory($category, $request, $path, $width=null , $height=null)
    {
        if ($request->has('file')) {
            $category->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'image' => UploaderService::UploadService($request, $path, $width , $height),
            ]);
        }else{
            $category->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
            ]);
        }

    }

    public function deleteCategory($category)
    {
        return $category->delete();
    }
}
