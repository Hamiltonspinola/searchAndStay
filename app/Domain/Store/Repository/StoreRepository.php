<?php

namespace App\Domain\Store\Repository;
use App\Domain\Store\Entities\Store;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentStore;

interface StoreRepository
{
    public function findAll(): array;
    public function findById(string $userId): ?Store;
    public function save(Store $Store): ?EloquentStore;
    public function delete(int $Store_id): void;
}
