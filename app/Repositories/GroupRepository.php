<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Group;

/**
 * Class GroupRepository.
 */
class GroupRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Group::class;
    }

    /**
     * @return Collection
     */
    public function getAllGroups()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findGroupById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $data
     * @return Model
     */
    public function create($data)
    {
        return $this->model->create($data);
    }
}
