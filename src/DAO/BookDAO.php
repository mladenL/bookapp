<?php

namespace bookapp\DAO;

use Doctrine\DBAL\Connection;
use bookapp\Domain\Book;

/**
* Allows access to Book data stored in Database
*/
class BookDAO extends DAO
{

    /**
     * @var \bookapp\DAO\ArticleDAO
     */

    private $authorDAO; //this var and below method are the dependency to Article object.


    private function setAuthorDAO(AuthorDAO $authorDAO) {
        $this->authorDAO = $authorDAO;
    }


    /**
     * Returns a list of all books according to their authors, sorted by Author id and Book id (from newest entry in db to oldest)
     * @return array A list of all books
     */

    public function findAll() {

        $sql = "SELECT * FROM book ORDER BY book_id";
        $result = $this->getDb()->fetchAll($sql);
        // Convert query result to an array of domain objects

        $books = array();
        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $book = $this->buildDomainObject($row);

        // The associated author is defined for the constructed book

            $book->setAuthor($author);
            $books[$bookId] = $book;

        }
        return $books;
    }

    /**
     * Creates an Comment object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \bookapp\Domain\Book
     */

    protected function buildDomainObject(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);


        if (array_key_exists('auth_id', $row)) {
            // Find and set the associated author
            $authorId = $row['auth_id'];
            $author = $this->authorDAO->find($authorId);
            $book->setAuthor($author);
        }
        
        return $book;
    }

}