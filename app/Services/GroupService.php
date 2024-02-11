<?php

namespace App\Services;

use App\Repositories\GroupRepository;

class GroupService
{
    protected $groupRepository;

    /**
     * @param GroupRepository $groupRepository
     */
    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return Collection
     */
    public function getAllGroups()
    {
        return $this->groupRepository->getAllGroups();
    }

    /**
     * @param $name
     * @return Model
     */
    public function createGroup($name)
    {
        return $this->groupRepository->create(['name' => $name]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findGroupById($id)
    {
        return $this->groupRepository->findGroupById($id);
    }
}
