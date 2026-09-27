@extends('layouts.student')

@section('title', $category->exists ? 'Edit category' : 'Add category')

@section('content')
<div class="mb-4">
    <a href="{{ route('categories.index') }}" class="text-decoration-none">
        ← Categories
    </a>
    <h1 class="h2 fw-bold mt-2">
        {{ $category->exists ? 'Edit category' : 'Add personal category' }}
    </h1>
</div>

<section class="panel" style="max-width:700px">
    <form method="POST"
          action="{{ $category->exists
              ? route('categories.update', $category)
              : route('categories.store') }}">
        @csrf

        @if ($category->exists)
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Category name</label>
            <input class="form-control" name="name" maxlength="80"
                   value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select class="form-select" name="type" required>
                <option value="expense"
                    @selected(old('type', $category->type ?? 'expense') === 'expense')>
                    Expense
                </option>
                <option value="income"
                    @selected(old('type', $category->type) === 'income')>
                    Income
                </option>
            </select>
        </div>

        <button class="btn btn-primary">
            {{ $category->exists ? 'Save changes' : 'Create category' }}
        </button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </form>
</section>
@endsection