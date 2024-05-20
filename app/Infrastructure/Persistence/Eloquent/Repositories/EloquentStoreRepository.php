<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Store\Entities\Store;
use App\Domain\Store\Repository\StoreRepository;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentStore;

class EloquentStoreRepository implements StoreRepository
{
    public function findAll(): array
    {
        return EloquentStore::all()->toArray();
    }

    public function findById($id): ?Store
    {
        $store = EloquentStore::find($id);
        if ($store) {
            return new Store($store->id, $store->name, $store->address, $store->active);
        }
        return null;
    }

    public function save(Store $store): ?EloquentStore
    {
        $eloquentStore = EloquentStore::updateOrCreate(
            ['id' => $store->getId()],
            ['name' => $store->getName(), 'address' => $store->getAddress(), 'active' => $store->getActive()]
        );
        return $eloquentStore;
        
    }

    public function delete($id): void
    {
        EloquentStore::destroy($id);
    }
}

