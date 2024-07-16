<?php
namespace App\Library\Domain\Book;

use APP\Library\Domain\Shared\ValueObject\UserId;

class Borrowing
{
    private $book;
    private $borrower;
    private $checkoutDate;
    private $checkinDate;

    public function __construct(Book $book, UserId $borrower, \DateTime $checkoutDate)
    {
        $this->book = $book;
        $this->borrower = $borrower;
        $this->checkoutDate = $checkoutDate;
        $this->checkinDate = null;
    }

    public function getCheckinDate(): ?\DateTime
    {
        return $this->checkinDate;
    }

    public function setCheckinDate(\DateTime $checkinDate): void
    {
        $this->checkinDate = $checkinDate;
    }
    
    public function getBorrower(): UserId
    {
        return $this->borrower;
    }

}
