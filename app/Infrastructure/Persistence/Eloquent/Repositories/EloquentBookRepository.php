<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Book\Entities\Book;
use App\Domain\Book\Repository\BookRepository;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;

class EloquentBookRepository implements BookRepository
{
    public function findAll(): array
    {
        return EloquentBook::all()->toArray();
    }

    public function findById($id): Book|EloquentBook
    {
        $book = EloquentBook::find($id);
        if ($book) {
            return new Book($book->id, $book->name, $book->isbn, $book->value);
        }
        return $book;
    }

    public function save(Book $book): Book|EloquentBook
    {
        $eloquentBook = EloquentBook::updateOrCreate(
            ['id' => $book->getId()],
            ['name' => $book->getName(), 'isbn' => $book->getIsbn(), 'value' => $book->getValue()]
        );
        return $eloquentBook ?? $book;
    }

    public function delete($id): void
    {
        EloquentBook::destroy($id);
    }

    public function attachStores(Book $book, array $storeIds): Book
    {
        $eloquentBook = EloquentBook::find($book->getId());
        $eloquentBook->stores()->syncWithoutDetaching($storeIds);

        return new Book($eloquentBook->id, $eloquentBook->name, $eloquentBook->isbn, $eloquentBook->value);
    }

    public function detachStores(Book $book, array $storeIds): Book
    {
        $eloquentBook = EloquentBook::find($book->getId());
        $existingStoreIds = $eloquentBook->stores()->pluck('stores.id')->toArray();

        $invalidStoreIds = array_diff($storeIds, $existingStoreIds);
        if (!empty($invalidStoreIds)) {
            throw new \Exception('Some stores are not related to this book: ' . implode(', ', $invalidStoreIds));
        }

        $eloquentBook->stores()->detach($storeIds);
        return new Book($eloquentBook->id, $eloquentBook->name, $eloquentBook->isbn, $eloquentBook->value);
    }

    public function syncStores(Book $book, array $storeIds): Book
    {
        $eloquentBook = EloquentBook::find($book->getId());
        $eloquentBook->stores()->sync($storeIds);

        return new Book($eloquentBook->id, $eloquentBook->name, $eloquentBook->isbn, $eloquentBook->value);
    }
}
