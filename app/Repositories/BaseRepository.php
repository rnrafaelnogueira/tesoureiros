<?php

namespace App\Repositories;
use Exception;
use DB;
use Carbon\Carbon;
use Bootstrapper\Interfaces\TableInterface;

class BaseRepository implements TableInterface
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

    public function where($column,$valor)
    {
        try {
            $query = $this->model->query();

            $query->where($column,'=', $valor);

            return $query->get();
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

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        // TODO: Implement getValueForHeader() method.
    }
}