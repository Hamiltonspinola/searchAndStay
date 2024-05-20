<?php
namespace App\Application\Store\Services;

use App\Domain\Store\Repository\StoreRepository;
use App\Domain\Store\Entities\Store;

class StoreService
{
    private $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStores(): array
    {
        return $this->storeRepository->findAll();
    }

    public function getStoreById($id): ?Store
    {
        return $this->storeRepository->findById($id);
    }

    public function createStore($name, $address, $active)
    {
        $store = new Store(null, $name, $address, $active);
        return $this->storeRepository->save($store);
    }

    public function updateStore($id, $name, $address, $active): ?Store
    {
        $store = $this->storeRepository->findById($id);
        if ($store) {
            $store = new Store($id, $name, $address, $active);
            $this->storeRepository->save($store);
        }
        return $store;
    }

    public function deleteStore($id): void
    {
        $this->storeRepository->delete($id);
    }
}
