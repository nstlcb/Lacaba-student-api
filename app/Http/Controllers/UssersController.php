<?php

namespace App\Http\Controllers;

use App\Models\Ussers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UssersController extends Controller
{
    // Get all users with filters
    public function index(Request $request)
    {
        $query = Ussers::query();

        // Fields filter
        if ($request->filled('fields')) {
            $fields = explode(',', $request->fields);
            $query->select($fields);
        }

        // Search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('firstname', 'like', "%$searchTerm%")
                  ->orWhere('lastname', 'like', "%$searchTerm%")
                  ->orWhere('nickname', 'like', "%$searchTerm%");
            });
        }

        // Sort filter
        if ($request->filled('sort')) {
            $sortParams = explode(',', $request->sort);
            foreach ($sortParams as $sortParam) {
                $sortDirection = 'asc';
                if (Str::startsWith($sortParam, '-')) {
                    $sortDirection = 'desc';
                    $sortParam = substr($sortParam, 1);
                }
                $query->orderBy($sortParam, $sortDirection);
            }
        }

        // Limit filter
        $limit = $request->filled('limit') ? $request->limit : 10;
        $users = $query->paginate($limit);

        return response()->json(['users' => $users], 200);
    }

    // Create a new user
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'age' => 'required|integer',
            'nickname' => 'nullable|string',
        ]);

        $user = Ussers::create($validatedData);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    // Get a single user by ID
    public function show($id)
    {
        $user = Ussers::findOrFail($id);

        return response()->json(['user' => $user], 200);
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstname' => 'string',
            'lastname' => 'string',
            'age' => 'integer',
            'nickname' => 'nullable|string',
        ]);

        $user = Ussers::findOrFail($id);
        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = Ussers::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
