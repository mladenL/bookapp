<?php

namespace bookapp\DAO;

use Doctrine\DBAL\Connection;
use bookap\Domain\Author;

/**
 * Allows access to Author data stored in Database
 */

class AuthorDAO {

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
     * Return a list of all authors
     *
     * @return array A list of all authors.
     */
    public function findAll() {
        $sql = "select * from author";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authorId = $row['auth_id'];
            $authors[$authorId] = $this->buildAuthor($row);
        }
        return $authors;
    }

	/**
     * Creates an Author object based on a DB row.
     *
     * @param array $row The DB row containing Author data.
     * @return \bookapp\Domain\Author
     */
    private function buildAuthor(array $row) {
        $author = new Author();
        $author->setAuthId($row['auth_id']);
        $author->setAuthFirstName($row['auth_first_name']);
        $author->setAuthLasrName($row['auth_last_name']);
        return $author;
    }

}