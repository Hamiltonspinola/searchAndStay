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

    public function findById($id): ?Book
    {
        $book = EloquentBook::find($id);
        if ($book) {
            return new Book($book->id, $book->name, $book->isbn, $book->value);
        }
        return null;
    }

    public function save(Book $book) :?EloquentBook
    {
        $eloquentBook = EloquentBook::updateOrCreate(
            ['id' => $book->getId()],
            ['name' => $book->getName(), 'isbn' => $book->getIsbn(), 'value' => $book->getValue()]
        );
        return $eloquentBook;
    }

    public function delete($id): void
    {
        EloquentBook::destroy($id);
    }
}
