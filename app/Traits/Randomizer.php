<?php

namespace App\Traits;

trait Randomizer
{
    public function createISBN(\App\Models\Book $book): void
    {
        do {
            $isbn = "978" . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (\App\Models\Book::where('isbn', $isbn)->exists());

        $book->update([
            'isbn' => $isbn
        ]);
    }
}
