<?php


namespace Product\Repositories;


use Product\Models\Product;
use Uploader\Http\Controller\UploaderController;
use Uploader\Repositories\UploaderRepository;
use Uploader\Services\UploaderService;
use App\Classes\FileUploader;
use App\Constants\Constants;
use Illuminate\Http\Request;

class ProductRepository
{
    public function allProducts()
    {
        return Product::all();
    }

    public function saveProduct($request, $path,$width=null,$height=null)
    {
        $uploader=new UploaderController(new UploaderRepository());
        return Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => UploaderService::UploadService($request, $path, $width , $height),
            'count' => $request->count,
            'price' => $request->price,
            'active' => $request->active,
            'description' => $request->description,
        ]);
    }

    public function updateProduct($product, $request, $path)
    {
        if ($request->has('file')) {
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'image' => FileUploader::uploader($request, $path),
                'count' => $request->count,
                'price' => $request->price,
                'active' => $request->active,
                'description' => $request->description
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'count' => $request->count,
                'price' => $request->price,
                'active' => $request->active,
                'description' => $request->description
            ]);
        }

    }

    public function delete($product)
    {
        $product->delete();

    }

}
