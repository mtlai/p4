<?php

class Author extends Eloquent {

	/**
	* Identify relation between Author and Book
	*/
	public function book() {
        # Author has many Books
        # Define a one-to-many relationship.
        return $this->hasMany('Book');
    }

    /**
	* When editing or adding a new book, we need a select dropdown of authors to choose from
	* A select is easy to generate when you have a key=>value pair to work with
	* This method will generate a key=>value pair of author id => author name
	*
	* @return Array
	*/
    public static function getIdNamePair() {

		$authors = Array();

		$collection = Author::all();

		foreach($collection as $author) {
			$authors[$author->id] = $author->name;
		}

		return $authors;
	}


}