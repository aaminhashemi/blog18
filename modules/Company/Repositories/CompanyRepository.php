<?php


namespace Company\Repositories;


use Company\Models\Company;
use Uploader\Http\Controller\UploaderController;
use Uploader\Repositories\UploaderRepository;
use Uploader\Services\UploaderService;
use App\Classes\FileUploader;
use App\Constants\Constants;

class CompanyRepository
{
    public function allCompanies()
    {
        return Company::all();
    }

    public function saveCompany($request)
    {
        return Company::create([
            'name' => $request->name,
        ]);
    }

    public function updateCompany($company, $request)
    {
        if ($request->has('file')) {
            $company->update([
                'name' => $request->name,
            ]);
        }else{
            $company->update([
                'name' => $request->name,
            ]);
        }

    }

    public function deleteCompany($company)
    {
        return $company->delete();
    }
}
