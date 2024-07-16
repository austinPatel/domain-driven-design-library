<?php
namespace App\Infrastructure\Doctrine\Repository;

use App\Library\Domain\Book\Book;
use Doctrine\ORM\EntityManagerInterface;
use App\Library\Domain\Shared\ValueObject\BookId;
use App\Library\Domain\Book\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function find(BookId $id): ?Book
    {
        return $this->entityManager->find(Book::class, $id->getId());
    }

    public function save(Book $book): void
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function remove(Book $book): void
    {
        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }
}
