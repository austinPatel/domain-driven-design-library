<?php
namespace App\Library\Domain\Book;

use Doctrine\Common\Collections\ArrayCollection;
use App\Library\Domain\Shared\ValueObject\BookId;
use App\Library\Domain\Shared\ValueObject\UserId;
use Doctrine\Common\Collections\Collection;



class Book
{
    private $id;
    private $title;
    private $status;
    private $borrowings;
    public function __construct(BookId $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
        $this->status = 'available';
        $this->borrowings = new ArrayCollection([]);
    }
    public function borrow( UserId $borrower): void
    {
        if ($this->status === 'available') {
            $borrowing = new Borrowing($this, $borrower, new \DateTime());
            $this->borrowings->add($borrowing);
            $this->status = 'unavailable';
        } else {
            throw new \Exception('Book is not available for borrowing.');
        }
    }

    public function returnBook(): void
    {
        foreach ($this->borrowings as $borrowing) {
            if ($borrowing->getCheckinDate() === null) {
                $borrowing->setCheckinDate(new \DateTime());
                $this->status = 'available';
                break;
            }
        }
    }

    public function getStatus(): string
    {
        return $this->status;
    }

}