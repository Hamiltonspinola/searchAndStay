<?php
namespace App\Interfaces\Http\Controllers;

use App\Application\Store\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        return response()->json($this->storeService->getAllStores());
    }

    public function show($id)
    {
        return response()->json($this->storeService->getStoreById($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $store = $this->storeService->createStore($validated['name'], $validated['address'], $validated['active']);
        return response()->json([
            'data' => $store,
            'message' => 'Store created!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'active' => 'sometimes|required|boolean',
        ]);

        $store = $this->storeService->updateStore($id, $validated['name'], $validated['address'], $validated['active']);
        return response()->json($store, 200);
    }

    public function destroy($id)
    {
        $this->storeService->deleteStore($id);
        return response()->json(null, 204);
    }
}
