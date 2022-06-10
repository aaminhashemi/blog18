<?php

namespace Product\Http\Controllers;

use Product\Models\Product;
use Product\Models\product_image;
use Product\Repositories\ProductRepository;
use App\Classes\FileUploader;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public $repository;
    public $product_dir= 'uploads/product/';
    public $gallery_dir= 'uploads/product/gallery/';
    public $image_width = 400;
    public $image_height = 400;
    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function index()
    {
        $products = $this->repository->allProducts();
        return response()->json(['products' => $products, 'status' => 200]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'category_id' => 'required|numeric',
            'file' => 'required|image|mimes:jpg,bmp,png,pdf',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string|min:5|max:500',
            'active' => 'required|boolean',
        ]);
        if ($validator->passes()) {
            $this->repository->saveProduct($request,$this->product_dir,$this->image_width,$this->image_height);
            return response()->json([
                'status' => 200,
                'message' => Constants::Success_message
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => Constants::Data_error,
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'category_id' => 'required|numeric',
            'file' => 'nullable|image|mimes:jpg,bmp,png,pdf',
            'count' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string|min:5|max:500',
            'active' => 'required|boolean',
        ]);
        if ($validator->passes()) {
            $this->repository->updateProduct($product, $request, $this->product_dir);
            return response()->json([
                'status' => 200,
                'message' => Constants::Success_message
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => Constants::Data_error,
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function gallerySave(Request $request)
    {
        // foreach ($request->file('file') as $item){
        // FileUploader::uploader($request);
        product_image::create([
            'product_id' => $request->id,
            'address' => FileUploader::uploader($request, $this->gallery_dir),
        ]);
        //}
    }

    public function getGallery($id)
    {
        $images = product_image::where('product_id', $id)->get();
        $product = Product::where('id', $id)->first();
        return response()->json(['status' => 200, 'images' => $images, 'product' => $product->name]);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json(['status' => 200, 'product' => $product]);
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        $this->repository->delete($product);
        return response()->json(['status' => 200]);

    }
}
