<?php
namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\Book\BorrowBookService;
use App\Application\Book\Command\BorrowBookCommand;

class BookController extends AbstractController
{
    private $borrowBookService;

    public function __construct(BorrowBookService $borrowBookService)
    {
        $this->borrowBookService = $borrowBookService;
    }

    /**
     * @Route("/borrow-book", name="borrow_book", methods={"POST"})
     */
    public function borrowBook(Request $request): Response
    {
        $bookId = $request->request->get('book_id');
        $borrower = $request->request->get('borrower');

        $command = new BorrowBookCommand($bookId, $borrower);
        $this->borrowBookService->borrowBook($command->getBookId(), $command->getBorrower());

        return new Response('Book borrowed successfully!');
    }

    /**
     * @Route("/return-book", name="return_book", methods={"POST"})
     */
    public function returnBook(Request $request): Response
    {
        $bookId = $request->request->get('book_id');

        $this->borrowBookService->returnBook($bookId);

        return new Response('Book returned successfully!');
    }
}
