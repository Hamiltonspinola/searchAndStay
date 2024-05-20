<?php

namespace App\Domain\Store\Repository;
use App\Domain\Store\Entities\Store;
interface StoreRepository
{
    public function findAll(): array;
    public function findById(string $userId): ?Store;
    public function save(Store $Store): void;
    public function delete(int $Store_id): void;
}
