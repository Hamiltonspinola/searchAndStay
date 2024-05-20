<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Domain\Book\Entities\Book;
use App\Application\Book\Services\BookService;
use App\Domain\Book\Repository\BookRepository;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;

class BookServiceTest extends TestCase
{
    public function testCreateBook()
    {
        $bookData = ['name' => 'Test Book', 'isbn' => 1234567890, 'value' => 20.50];
        $bookService = $this->createBookService($bookData);        
        $this->assertBookCreation($bookService, $bookData);
    }
    
    private function createBookService(array $bookData)
    {
        $bookRepositoryMock = $this->createMock(BookRepository::class);
        $bookRepositoryMock->method('save')->willReturn(new Book(null, $bookData['name'], $bookData['isbn'], $bookData['value']));
        return new BookService($bookRepositoryMock);
    }

    private function assertBookCreation($bookService, $bookData)
    {
        $book = $bookService->createBook($bookData['name'], $bookData['isbn'], $bookData['value']);
        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals($bookData['name'], $book->getName());
        $this->assertEquals($bookData['isbn'], $book->getIsbn());
        $this->assertEquals($bookData['value'], $book->getValue());
    }
}

