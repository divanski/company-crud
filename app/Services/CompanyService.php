<?php

namespace App\Services;
use App\Repositories\CompanyRepository;

/**
 * Class CompanyService.
 */
class CompanyService
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllCompaniesWithGroups()
    {
        return $this->companyRepository->getAllCompaniesWithGroups();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function storeCompany($data)
    {
        return $this->companyRepository->storeOrUpdateCompany($data);
    }

    /**
     * @param $company
     * @param $groupIds
     * @return void
     */
    public function syncGroups($company, $groupIds)
    {
        if (!empty($groupIds)) {
            $groupIds = array_map('intval', explode(',', $groupIds));
            $this->companyRepository->syncGroups($company, $groupIds);
        } else {
            // If no groups are selected, remove all groups from the company
            $this->companyRepository->removeAllGroups($company);
        }
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getCompanyById($id)
    {
        return $this->companyRepository->getCompanyById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCompany($id)
    {
        return $this->companyRepository->deleteCompany($id);
    }
}
