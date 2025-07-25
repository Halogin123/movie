<?php

namespace MovieChill\Application;
class BaseService
{
    public function getList($params, $all = false)
    {
        if ($all) {
            $params['page_size'] = ADMIN_PAGE_SIZE;
        }

        return $this->getRepository()->findBy($params, $all);
    }

    public function getDetail($id)
    {
        return $this->getRepository()->findOne($id);
    }

    public function update($param, $id): void
    {
        $data = $this->getRepository()->findOne($id);
        $this->getRepository()->update($data, $param);
    }

    public function create($param)
    {
        return $this->getRepository()->save($param);
    }

    public function delete($id)
    {
        $data = $this->getRepository()->findOne($id);
        return $this->getRepository()->delete($data);
    }

    private function getRepository()
    {
        if (property_exists($this, 'repository') && !empty($this->repository)) {
            return $this->repository;
        } else {
            throw new \InvalidArgumentException('The property "repository" is not defined');
        }
    }
}
