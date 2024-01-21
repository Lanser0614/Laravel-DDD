<?php

namespace Modules\BaseModule\BaseRepository;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\BaseModule\BaseAggregate\AggregateRoot;
use Modules\BusinessCode\Credit\Entity\ECredit;

interface BaseRepositoryInterface
{
    /**
     * @param Builder $model
     * @return BaseRepositoryInterface
     */
    public function setModel(Builder $model): BaseRepositoryInterface;

    /**
     * @param array $relations
     * @return BaseRepositoryInterface
     */
    public function with(array $relations = []): BaseRepositoryInterface;

    /**
     * @param int $id
     * @param array $relations
     * @param string $column
     * @return BaseRepositoryInterface
     */
    public function whereId(int $id, array $relations = [], string $column = 'uuid'): BaseRepositoryInterface;

    /**
     * @return array
     */
    public function getEntityList(): array;

    /**
     * @return ECredit|null
     */
    public function getEntity(): ECredit|null;

    /**
     * @param int $perPage
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator;

    public function save(AggregateRoot $aggregateRoot);
}
