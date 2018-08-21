<?php

namespace App\Repositories;
use Exception;
use DB;
use Carbon\Carbon;

class BaseRepository
{
    protected $model;

    public function paginate($paginate = 10, $orderBy, $sort)
    {
        try {
            $query = $this->model->query();
            $query->orderBy($orderBy, $sort);

            return $query->paginate($paginate);
        } catch(Exception $e) {
            return [''=>$e->getMessage()];
        }
    }

    public function paginateWhere($paginate = 10, $orderBy, $sort, $columns)
    {
        try {
            $query = $this->model->query();

            if (count($columns) > 0) {
                foreach ($columns as $key => $value) {
                    if ($value != "") {
                        $query->where($key,'like', '%'.$value.'%');

                    }
                }
            }
            return $query->paginate($paginate);
        } catch(Exception $e) {
            return [''=>$e->getMessage()];
        }
    }

    public function add($data)
    {
        try {

            $object = new $this->model($data);
            $object->save();

            return TRUE;
        } catch(Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }

    public function find($id)
    {
        try {
            return $this->model->find($id);
        } catch(Exception $e) {
            return [''=>$e->getMessage()];
        }
    }

    public function findTrashed($id)
    {
        try {
            return $this->model->withTrashed()->find($id);
        } catch(Exception $e) {
            return [''=>$e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            $object = $this->model->find($id);
            $object->delete();

            return TRUE;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $object = $this->model->withTrashed()->find($id);
            $object->restore();

            DB::commit();

            return TRUE;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function edit($id, $data)
    {
        try {
            DB::beginTransaction();

            $object = $this->model->find($id);
            $object->fill($data);
            $object->save();

            DB::commit();

            return TRUE;
        } catch(Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}