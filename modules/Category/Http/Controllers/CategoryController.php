<?php


namespace Category\Http\Controllers;


use Category\Models\Category;
use Illuminate\Support\Facades\Auth;
use Product\Models\Product;
use Category\Repositories\CategoryRepository;
use Category\Models\Category_brand;
use App\Classes\ResponseManager;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public $repository;
    public $image_width = 400;
    public $image_height = 400;
    public $category_dir = 'uploads/category/';

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }
    /////////////////////////////////////////////////
    public function menu()
    {
        $menu= config('sidebar');
        //dd($menu);
        $array=[];
        $user=Auth::user();
        foreach ($user->roles as $item){
            $permissions=$item->permissions()->get();
            foreach ($permissions as $val){
                $array[] = $val->name;
            }
        }
        foreach ($menu as  $key =>$menu_item){
            //dd($menu_item['permission']);
            if(!in_array($menu_item['permission'],$array)){
                 unset($menu[$key]);
               //dd($menu_item['permission']);
              //
            }
        }
        //dd($menu);

        // $menu = (array) $menu;
        return response()->json(['menu' => array_values($menu)]);
    }

    ////////////////////////////////////////////////
    public function index()
    {
        $categories = $this->repository->allCategories();
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    public function parentIndex()
    {
        $categories = $this->repository->findParents();
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    public function find($id)
    {
        $category = Category::where('id', $id)->first();
        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }

    public function parentIndexExcept(Category $category)
    {
        $categories = $this->repository->findParentsExcept($category);
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    public function save(Request $request)
    {
        //return response()->json(['ggg'=>'f']);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'file' => 'required|image|mimes:jpg,bmp,png,pdf',
        ]);
        if ($validator->passes()) {
            $this->repository->saveCategory($request, $this->category_dir, $this->image_width, $this->image_height);
            return response()->json([
                'status' => 200,
                'message' => 'ثبت دسته با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'category_id' => 'nullable',
            'file' => 'nullable|present|image|mimes:jpg,bmp,png,pdf',
        ]);
        $category = Category::where('id', $id)->first();
        if ($validator->passes()) {
            $this->repository->updateCategory($category, $request,$this->category_dir,$this->image_width,$this->image_height);
            return response()->json([
                'status' => 200,
                'message' => 'ویرایش دسته با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function saveScore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'category' => 'required|array|min:1',
            'label' => 'nullable|array|min:1',
        ]);
        //$category = Category::where('id', $id)->first();
        if (!$validator->passes()) {
            /*$this->repository->updateCategory($category, $request);
            return response()->json([
                'status' => 200,
                'message' => 'ویرایش دسته با موفقیت انجام شد.'
            ]);
        } else {*/
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function delete($id)
    {
        $category=Category::where('id',$id)->first();
        $this->repository->deleteCategory($category);
        return response()->json(['status' => 200]);
    }

    public function menuCategory()
    {
        $categories = Category::with('children')->whereNull('category_id')->get();
        return response()->json(['status' => 200, 'categories' => $categories]);
    }

    public function getBrands($id)
    {
        $brands = Category_brand::where('category_id', $id)->get();
        return response()->json(['status' => 200, 'category_brands' => $brands]);

    }

    public function saveBrands($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
        ]);
        if ($validator->passes()) {
            foreach ($request->brand_id as $item) {
                Category_brand::create([
                    'category_id' => $id,
                    'brand_id' => $item
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'ویرایش دسته با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function categoryProducts($id)
    {
        $category_products = Product::where('category_id', $id)->get();
        return response()->json(['status' => 200, 'products' => $category_products]);
    }

    public function categoryProductsOrder($id, $standard)
    {
        $category_products = Product::where('category_id', $id)->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 200, 'products' => $category_products]);
    }

    public function deleteBrand($id)
    {
        $category_brand = Category_brand::findOrFail($id);
        $category_brand->delete();
        return response()->json(['status' => 200, 'message' => Constants::Success_message]);
    }

    public function getSubCategories($id)
    {
        $subcategories=Category::where('category_id',$id)->get();
        return response()->json(['status' => 200, 'subcategories' => $subcategories]);
    }
}
