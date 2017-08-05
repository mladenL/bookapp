<?php

namespace bookapp\DAO;

use Doctrine\DBAL\Connection;
use bookap\Domain\Author;

/**
 * Allows access to Author data stored in Database
 */

class AuthorDAO {

/**
     * Return a list of all authors
     *
     * @return array A list of all authors.
     */
    public function findAll() {
        $sql = "SELECT * FROM author ORDER BY auth_id";
        $result = $this->db->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authorId = $row['auth_id'];
            $authors[$authorId] = $this->buildDomainObject($row);
        }
        return $authors;
    }

	/**
     * Creates an Author object based on a DB row.
     *
     * @param array $row The DB row containing Author data.
     * @return \bookapp\Domain\Author
     */
    private function buildDomainObject(array $row) {
        $author = new Author();
        $author->setAuthId($row['auth_id']);
        $author->setAuthFirstName($row['auth_first_name']);
        $author->setAuthLasrName($row['auth_last_name']);
        return $author;
    }

    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\Article|throws an exception if no matching article is found
     */
    public function find($authorId) {
        $sql = "SELECT * FROM author WHERE auth_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($authorId));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No Author matching id " . $authorId);
    }

}