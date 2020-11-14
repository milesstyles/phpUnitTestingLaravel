<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookReservationTest extends TestCase
{
    /** @test */
    use RefreshDatabase;

    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Victor',
        ]);
        $response->assertOk();
        $this->assertCount(1,Book::all());
    }

     /** @test */
    public function a_title_is_required()
    {
       

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Victor',
        ]);
        
        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_author_is_required()
    {
       

        $response = $this->post('/books', [
            'title' => 'Cool title',
            'author' => '',
        ]);
        
        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool title',
            'author' => 'ted',
        ]);
        
        $book = Book::first();

        $response = $this ->patch('/books/' . $book->id,[
            'title' => 'New title',
            'author' => 'New author',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New author', Book::first()->author);
    }
}
