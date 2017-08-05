<?php

namespace bookapp\DAO;

use Doctrine\DBAL\Connection;

/**
* Constructs connexion to DB for all objects
* Declares the function which builds object
*/
abstract class DAO
{

	 /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;


	 /**
	 * Constructor
	 * @param  Doctrine\DBAL\Connection the db connexion object
	 */	
	public function __construct(Connection $db)
	{
		$this->db = $db;
	}

	/**
	 * $db getter
	 * @return \Doctrine\DBAL\Connection The database connection object
	 */

	protected function getDb() {
		return $this->db;
	}

	 /**
     * Builds a domain object from a DB row.
     * Must be overridden by child classes.
     */
    protected abstract function buildDomainObject(array $row);
}