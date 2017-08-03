<?php

namespace bookapp\DAO;

use Doctrine\DBAL\Connection;
use bookapp\Domain\Book;

/**
* Allows access to Book data stored in Database
*/
class BookDAO
{

    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
	
	public function __construct(Connection $db)
	{
		$this->db = $db;
	}



	/**
     * Return a list of all books, sorted by descending id (most recent first).
     *
     * @return array A list of all books.
     */
    public function findAll() {
        $sql = "select * from book order by book_id desc";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildBook($row);
        }
        return $books;
    }



     /**
     * Creates an Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \bookapp\Domain\Book
     */
    private function buildBook(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        $book->getAuthorId($row['auth_id']);
        return $book;
    }
}