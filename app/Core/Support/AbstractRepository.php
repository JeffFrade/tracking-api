<?php

namespace App\Core\Support;

use App\Core\Support\Interfaces\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function all(array $cols = ['*'])
    {
        return $this->model->withTrashed()->get($cols);
    }

    public function allNoTrashed(array $cols = ['*'])
    {
        return $this->model->get($cols);
    }

    public function paginate(int $perPage = 15, array $cols = ['*'])
    {
        return $this->model->paginate($perPage, $cols);
    }

    public function find($value)
    {
        return $this->model->where('id', $value)->get();
    }

    public function findFirst(string $field, string $value)
    {
        return $this->model->where($field, $value)->first();
    }

    public function findBy(string $field, string $value, array $columns = ['*'])
    {
        return $this->model->where($field, $value)->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function updateCustom(array $data, int $id, string $attribute = 'id')
    {
        return $this->model->where($attribute, $id)->update($data);
    }

    public function update(array $data, int $id)
    {
        $instance = $this->model->find($id);
        $instance->fill($data);

        return $instance->save();
    }

    public function customDelete(string $field, string $value)
    {
        return $this->model->where($field, $value)->delete();
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function retrieveDelete(string $value, string $field = 'id')
    {
        $instance = $this->model->onlyTrashed()
            ->where($field, $value)
            ->first();

        return $instance->restore();
    }
}
