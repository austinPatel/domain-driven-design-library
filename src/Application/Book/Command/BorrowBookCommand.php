<?php
namespace App\Application\Book\Command;

class BorrowBookCommand
{
    private $bookId;
    private $borrower;

    public function __construct(string $bookId, string $borrower)
    {
        $this->bookId = $bookId;
        $this->borrower = $borrower;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function getBorrower(): string
    {
        return $this->borrower;
    }
}
