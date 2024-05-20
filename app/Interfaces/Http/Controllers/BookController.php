<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Book\Services\BookService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return response()->json($this->bookService->getAllBooks());
    }

    public function show($id)
    {
        return response()->json($this->bookService->getBookById($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'isbn' => 'required|numeric',
            'value' => 'required|numeric',
        ]);

        $book = $this->bookService->createBook($validated['name'], $validated['isbn'], $validated['value']);
        return response()->json([
            'data' => $book,
            'message' => 'Book created!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'isbn' => 'sometimes|required|numeric',
            'value' => 'sometimes|required|numeric',
        ]);

        $book = $this->bookService->updateBook($id, $validated['name'], $validated['isbn'], $validated['value']);
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $this->bookService->deleteBook($id);
        return response()->json(null, 204);
    }
}
