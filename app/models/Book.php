<?php

class Book extends Eloquent {

    # The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at');

    /**
    * Book belongs to Author
    * Define an inverse one-to-many relationship.
    */
	public function author() {

        return $this->belongsTo('Author');

    }

    /**
    * Books belong to many Tags
    */
    public function tags() {

        return $this->belongsToMany('Tag');

    }

    /**
    * This array will compare an array of given tags with existing tags
    * and figure out which ones need to be added and which ones need to be deleted
    */
    public function updateTags($new = array()) {

        // Go through new tags to see what ones need to be added
        foreach($new as $tag) {
            if(!$this->tags->contains($tag)) {
                $this->tags()->save(Tag::find($tag));
            }
        }

        // Go through existing tags and see what ones need to be deleted
        foreach($this->tags as $tag) {
            if(!in_array($tag->pivot->tag_id,$new)) {
                $this->tags()->detach($tag->id);
            }
        }
    }

    /**
    * Search among books, authors and tags
    * @return Collection
    */
    public static function search($query) {

        # If there is a query, search the library with that query
        if($query) {

            # Eager load tags and author
            $books = Book::with('tags','author')
            ->whereHas('author', function($q) use($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->orWhereHas('tags', function($q) use($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->orWhere('title', 'LIKE', "%$query%")
            ->orWhere('published', 'LIKE', "%$query%")
            ->get();

            # Note on what `use` means above:
            # Closures may inherit variables from the parent scope.
            # Any such variables must be passed to the `use` language construct.

        }
        # Otherwise, just fetch all books
        else {
            # Eager load tags and author
            $books = Book::with('tags','author')->get();
        }

        return $books;
    }



    /**
    * Searches and returns any books added in the last 24 hours
    *
    * @return Collection
    */
    public static function getBooksAddedInTheLast24Hours() {

        # Timestamp of 24 hours ago
        $past_24_hours = strtotime('-1 day');

        # Convert to MySQL timestamp
        $past_24_hours = date('Y-m-d H:i:s', $past_24_hours);

        $books = Book::where('created_at','>',$past_24_hours)->get();

        return $books;

    }


    /**
    *
    *
    * @return String
    */
    public static function sendDigests($users,$books) {

        $recipients = '';

        $data['books'] = $books;

        foreach($users as $user) {

            $data['user'] = $user;

            /*
            Mail::send('emails.digest', $data, function($message) {

                $recipient_email = $user->email;
                $recipient_name  = $user->first_name.' '.$user->last_name;
                $subject  = 'Foobooks Digest';

                $message->to($recipient_email, $recipient_name)->subject($subject);

            });
            */

            $recipients .= $user->email.', ';

        }

        $recipients = rtrim($recipients, ',');

        return $recipients;

    }


}