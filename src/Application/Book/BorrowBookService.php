<?php
namespace App\Application\Book;

use App\Library\Domain\Shared\ValueObject\BookId;
use App\Library\Domain\Book\BookRepositoryInterface;



class BorrowBookService
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function borrowBook(string $bookId, string $borrower): void
    {
        $book = $this->bookRepository->find(new BookId($bookId));
        if ($book) {
            $book->borrow($borrower);
            $this->bookRepository->save($book);
        }
    }

    public function returnBook(string $bookId): void
    {
        $book = $this->bookRepository->find(new BookId($bookId));
        if ($book) {
            $book->returnBook();
            $this->bookRepository->save($book);
        }
    }
}
