<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Book\Services\BookService;
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

    public function attachStores(Request $request, $id)
    {
        $validated = $request->validate([
            'store_ids' => 'required|array',
            'store_ids.*' => 'exists:stores,id',
        ]);

        $this->bookService->attachStores($id, $validated['store_ids']);
        return response()->json(['message' => 'Stores attached successfully'], 200);
    }

    public function detachStores(Request $request, $id)
    {
        $storeIds = $request->input('store_ids');
        try {
            $book = $this->bookService->detachStores($id, $storeIds);
            return response()->json(['message' => 'Stores detached successfully', 'book' => $book], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function syncStores(Request $request, $id)
    {
        $storeIds = $request->input('store_ids');
        $book = $this->bookService->syncStores($id, $storeIds);
        return response()->json($book, 200);
    }
}
