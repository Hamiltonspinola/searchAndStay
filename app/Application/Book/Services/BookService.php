<?php

namespace App\Application\Book\Services;

use App\Domain\Book\Repository\BookRepository;
use App\Domain\Book\Entities\Book;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;

class BookService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks(): array
    {
        return $this->bookRepository->findAll();
    }

    public function getBookById($id): ?Book
    {
        return $this->bookRepository->findById($id);
    }

    public function createBook($name, $isbn, $value)
    {
        $book = new Book(null, $name, $isbn, $value);
        $response = $this->bookRepository->save($book);
        return $response;
        
    }

    public function updateBook($id, $name, $isbn, $value): ?Book
    {
        $book = $this->bookRepository->findById($id);
        if ($book) {
            $book = new Book($id, $name, $isbn, $value);
            $this->bookRepository->save($book);
        }
        return $book;
    }

    public function deleteBook($id): void
    {
        $this->bookRepository->delete($id);
    }

    public function attachStores($bookId, array $storeIds): ?Book
    {
        $book = $this->bookRepository->findById($bookId);
        if ($book) {
            return $this->bookRepository->attachStores($book, $storeIds);
        }
        return null;
    }

    public function detachStores($bookId, array $storeIds): ?Book
    {
        $book = $this->bookRepository->findById($bookId);
        if ($book) {
            try {
                return $this->bookRepository->detachStores($book, $storeIds);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return null;
    }

    public function syncStores($bookId, array $storeIds): ?Book
    {
        $book = $this->bookRepository->findById($bookId);
        if ($book) {
            return $this->bookRepository->syncStores($book, $storeIds);
        }
        return null;
    }
}
