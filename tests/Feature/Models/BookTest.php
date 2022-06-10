<?php

namespace Tests\Feature\Models;

use Book\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert()
    {
        Book::factory()->create();

    }
}
