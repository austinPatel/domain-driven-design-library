<?php
namespace App\Library\Domain\Book;
use App\Library\Domain\Shared\ValueObject\BookId;

interface BookRepositoryInterface
{
    public function find(BookId $id): ?Book;
    public function save(Book $book): void;
    public function remove(Book $book): void;
}
