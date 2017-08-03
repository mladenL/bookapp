<?php

namespace bookapp\DAO;

use Doctrine\DBAL\Connection;
use bookapp\Domain\Book;

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
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Return a list of all Books, sorted by date (most recent first).
     *
     * @return array A list of all Books.
     */
    public function findAll() {
        $sql = "select * from book_list order by id desc";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $Books = array();
        foreach ($result as $row) {
            $BookId = $row['id'];
            $Books[$BookId] = $this->buildBook($row);
        }
        return $Books;
    }

    /**
     * Creates an Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \MicroCMS\Domain\Book
     */
    private function buildBook(array $row) {
        $Book = new Book();
        $Book->setId($row['id']);
        $Book->setTitle($row['book_title']);
        $Book->setContent($row['book_content']);
        return $Book;
    }
}