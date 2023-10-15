<?php

namespace App\Repositories\Interface;

/**
 * Interface BaseQueriesInterface
 */
interface BaseRepositoryInterface {

    /**
     * @param array $columns
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id);
}
