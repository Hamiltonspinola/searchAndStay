<?php

namespace App\Domain\Book\Repository;

use App\Domain\Book\Entities\Book;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;

interface BookRepository
{
    public function findAll(): array;
    public function findById(string $userId): ?Book;
    public function save(Book $book) :?EloquentBook;
    public function delete(int $book_id): void;
}
