<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;
    protected $groupService;

    /**
     * @param CompanyService $companyService
     * @param GroupService $groupService
     */
    public function __construct(CompanyService $companyService, GroupService $groupService)
    {
        $this->companyService = $companyService;
        $this->groupService = $groupService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->companyService->getAllCompaniesWithGroups();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('groups', function ($company) {
                    $badge = '';
                    if ($company->groups) {
                        foreach ($company->groups as $group) {
                            $badge .= ' <span class="badge badge-info">' . $group->name . '</span>';
                        }
                    }
                    return $badge;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)"
                            data-toggle="tooltip"
                            data-id="' . $row->id . '"
                            data-original-title="Edit"
                            class="edit btn btn-primary btn-sm editCompany"><i class="bi bi-pen"></i> Edit</a>';

                    $btn .= ' <a href="javascript:void(0)"
                                     data-toggle="tooltip"
                                     data-id="' . $row->id . '"
                                     data-original-title="Delete"
                                     class="btn btn-danger btn-sm deleteCompany"><i class="bi bi-trash3"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['groups', 'action'])
                ->make(true);
        }

        $groups = $this->groupService->getAllGroups();

        return view('company', compact('groups'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $company = $this->companyService->storeCompany($request->all());
        $this->companyService->syncGroups($company, $request->input('groups'));
        return response()->json(['success' => 'Company saved successfully.']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $company = $this->companyService->getCompanyById($id);

        return response()->json($company);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->companyService->deleteCompany($id);

        return response()->json(['success' => 'Company deleted successfully.']);
    }
}
