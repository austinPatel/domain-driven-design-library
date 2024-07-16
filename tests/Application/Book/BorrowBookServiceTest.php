<?php
namespace App\Tests\Application\Book;

use PHPUnit\Framework\TestCase;
use App\Library\Domain\Book\Book;
use App\Application\Book\BorrowBookService;
use App\Library\Domain\Shared\ValueObject\BookId;
use App\Library\Domain\Book\BookRepositoryInterface;

class BorrowBookServiceTest extends TestCase
{
    private $bookRepository;
    private $borrowBookService;

    protected function setUp(): void
    {
        $this->bookRepository = $this->createMock(BookRepositoryInterface::class);
        $this->borrowBookService = new BorrowBookService($this->bookRepository);
    }

    public function testBookCanBeBorrowed(): void
    {
        $bookId = new BookId('1');
        $book = new Book($bookId, 'Implementing Domain driven design');
        
        $this->bookRepository->method('find')->willReturn($book);
        
        $this->borrowBookService->borrowBook('1', 'Hardik');
        
        $this->assertEquals('unavailable', $book->getStatus());
    }

    public function testBookCannotBeBorrowedTwice(): void
    {
        $bookId = new BookId('1');
        $book = new Book($bookId, 'Implementing Domain driven design');
        
        $this->bookRepository->method('find')->willReturn($book);
        
        $this->borrowBookService->borrowBook('1', 'Hardik');
        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Book is not available for borrowing.');
        
        $this->borrowBookService->borrowBook('1', 'Kumar');
    }

    public function testBookCanBeReturned(): void
    {
        $bookId = new BookId('1');
        $book = new Book($bookId, 'Implementing Domain driven design');
        
        $this->bookRepository->method('find')->willReturn($book);
        
        $this->borrowBookService->borrowBook('1', 'Hardik');
        $this->borrowBookService->returnBook('1');
        
        $this->assertEquals('available', $book->getStatus());
    }
}
