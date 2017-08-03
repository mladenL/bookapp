<?php

namespace bookapp\Domain;

class Author
{

	/**
	 * Author id.
	 *
	 * @var integer
	 */	

	private $authId;

	/**
	 * Author First Name.
	 *
	 * @var string
	 */	

	private $authFirstName;

	/**
	 * Author Last Name.
	 *
	 * @var string
	 */	

	private $authLastName;

	

	public function getAuthId() {
		return $this->id;
	}

	public function setAuthId($authId) {
		$this->authId = $authId;
		return $this;
	}

	public function getAuthFirstName() {
		return $this->authFirstName;
	}

	public function setAuthFirstName($authLastName) {
		$this->authLastName
 = 	$authLastName;
 		return $this;
	}

	public function getBook() {
        return $this->book;
    }

    public function setBook(Book $book) {
        $this->book = $book;
        return $this;
    }

}