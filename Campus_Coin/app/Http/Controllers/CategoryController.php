<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', auth()->id());
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get()
            ->groupBy('type');

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.form', [
            'category' => new Category(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $this->ensureUniqueName($data);

        auth()->user()->categories()->create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Personal category added.');
    }

    public function edit(Category $category)
    {
        $this->checkOwner($category);

        return view('categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->checkOwner($category);

        $data = $this->validatedData($request);

        if ($category->transactions()->exists() && $data['type'] !== $category->type) {
            throw ValidationException::withMessages([
                'type' => 'This category already has transactions, so its type cannot be changed.',
            ]);
        }

        $this->ensureUniqueName($data, $category->id);
        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        $this->checkOwner($category);

        if ($category->transactions()->exists()) {
            return back()->withErrors([
                'category' => 'This category has transactions. It cannot be deleted yet.',
            ]);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'type' => ['required', 'in:income,expense'],
        ]);

        $data['name'] = trim($data['name']);

        return $data;
    }

    private function ensureUniqueName(array $data, ?int $ignoreId = null): void
    {
        $query = Category::query()
            ->where('type', $data['type'])
            ->whereRaw('LOWER(name) = ?', [mb_strtolower($data['name'])])
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', auth()->id());
            });

        if ($ignoreId !== null) {
            $query->where('id', '!=', $ignoreId);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'name' => 'This category name already exists in this category type.',
            ]);
        }
    }

    private function checkOwner(Category $category): void
    {
        abort_unless(
            $category->user_id !== null
                && (int) $category->user_id === (int) auth()->id(),
            404
        );
    }
}