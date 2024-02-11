<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Company;

/**
 * Class CompanyRepository.
 */
class CompanyRepository extends BaseRepository
{
    public function model(): string
    {
        return Company::class;
    }

    /**
     * @return Collection
     */
    public function getAllCompaniesWithGroups()
    {
        return $this->model->with('groups')->orderBy('created_at', 'desc')->get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function storeOrUpdateCompany($data)
    {
        $companyId = data_get($data, 'company_id');

        if (filled($companyId)) {
            return $this->model->updateOrCreate(['id' => $companyId], $data);
        } else {
            return $this->model->create($data);
        }
    }

    /**
     * @param Company $company
     * @param $groupIds
     * @return void
     */
    public function syncGroups(Company $company, $groupIds)
    {
        $company->groups()->sync($groupIds);
    }

    public function getCompanyById($id)
    {
        return $this->model->with('groups')->find($id);
    }

    /**
     * @param $company
     * @return void
     */
    public function removeAllGroups($company)
    {
        $company->groups()->detach();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCompany($id): mixed
    {
        return $this->model->find($id)->delete();
    }
}
