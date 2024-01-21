<?php
declare(strict_types=1);

namespace Modules\BaseModule\BaseRepository;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\BaseModule\BaseAggregate\AggregateRoot;
use Modules\BusinessCode\Credit\Entity\ECredit;

class BaseRepository implements BaseRepositoryInterface
{
    protected Builder $model;
    public function setModel(Builder $model): BaseRepositoryInterface
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param array $relations
     * @return BaseRepositoryInterface
     */
    public function with(array $relations = []): BaseRepositoryInterface
    {
        $this->model->with($relations);
        return $this;
    }

    /**
     * @param int $id
     * @param array $relations
     * @param string $column
     * @return BaseRepositoryInterface
     */
    public function whereId(int $id, array $relations = [], string $column = 'uuid'): BaseRepositoryInterface
    {
        $this->model->with($relations)->where($column,'=', $id);
        return $this;
    }

    /**
     * @return array
     */
    public function getEntityList(): array
    {
        return $this->model
            ->get()
            ->map
            ->toEntity()
            ->toArray();
    }

    /**
     * @return ECredit|null
     */
    public function getEntity(): ECredit|null
    {
        return $this->model->first()?->toEntity();
    }

    /**
     * @param int $perPage
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, ['*'], $page);
    }

    public function save(AggregateRoot $aggregateRoot): void {
        $this->model->insert($aggregateRoot->jsonSerialize());
    }
}
