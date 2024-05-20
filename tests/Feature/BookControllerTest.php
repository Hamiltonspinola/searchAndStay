<?php

namespace Tests\Feature;

use App\Domain\Book\Entities\Book;
use App\Domain\Store\Entities\Store;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentBook;
use App\Infrastructure\Persistence\Eloquent\Models\EloquentStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class BookControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testCreateBook()
    {
        $bookData = ["name" => "Test Book", "isbn" => 1234567890, "value" => 20];

        $response = $this->postJson('/api/books/store', $bookData,[
            'Accept' => "application/json",
            "Content-Type" => "application/json"
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(["data", "message"])
                 ->assertJson([
                     "data" => $bookData,
                     "message" => "Book created!"
                 ]);
    }

    public function testAttachStoresToBook()
    {
        $book = EloquentBook::factory()->create();
        $stores = EloquentStore::factory()->count(2)->create();

        $response = $this->postJson("/api/books/{$book->id}/attach-stores", [
            'store_ids' => $stores->pluck('id')->toArray()
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Stores attached successfully']);

        $book->refresh(); // Recarregar o modelo para garantir que as associações estão atualizadas

        $this->assertCount(2, $book->stores);
    }

    public function testDetachStoresFromBook()
    {
        $book = EloquentBook::factory()->create();
        $stores = EloquentStore::factory()->count(2)->create();
        $book->stores()->attach($stores);

        $response = $this->postJson("/api/books/{$book->id}/detach-stores", [
            'store_ids' => $stores->pluck('id')->toArray()
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Stores detached successfully']);
        
        $this->assertCount(0, $book->stores);
    }
}
