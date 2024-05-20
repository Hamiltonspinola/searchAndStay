<?php

namespace App\Application\Book\Services;

use App\Domain\Book\Repository\BookRepository;
use App\Domain\Book\Entities\Book;

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
        return $this->bookRepository->save($book);
        
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
}
