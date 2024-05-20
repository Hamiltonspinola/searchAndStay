<?php

namespace App\Domain\Book\Repository;

use App\Domain\Book\Entities\Book;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;

interface BookRepository
{
    public function findAll(): array;
    public function findById(string $userId): Book|EloquentBook;
    public function save(Book $book) :Book|EloquentBook;
    public function delete(int $book_id): void;
    public function attachStores(Book $book, array $storeIds) :?Book;
    public function detachStores(Book $book, array $storeIds) :?Book;
    public function syncStores(Book $book, array $storeIds) :?Book;
}
