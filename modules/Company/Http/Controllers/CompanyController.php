<?php


namespace Company\Http\Controllers;


use Company\Models\Company;
use Product\Models\Product;
use Company\Repositories\CompanyRepository;
use App\Classes\ResponseManager;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public $repository;

    public function __construct(CompanyRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }


    public function index()
    {
        $companies = $this->repository->allCompanies();
        return response()->json([
            'status' => 200,
            'companies' => $companies
        ]);
    }

    public function find($id)
    {
        $company = Company::where('id', $id)->first();
        return response()->json([
            'status' => 200,
            'company' => $company
        ]);
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
        ]);
        if ($validator->passes()) {
            $this->repository->saveCompany($request);
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
        ]);
        $category = Company::where('id', $id)->first();
        if ($validator->passes()) {
            $this->repository->updateCompany($category, $request);
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

    public function delete($id)
    {
        $company=Company::where('id',$id)->first();
        $this->repository->deleteCompany($company);
        return response()->json(['status' => 200]);
    }

}
