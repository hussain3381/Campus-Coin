@extends('layouts.student')

@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h2 fw-bold mb-1">Categories</h1>
        <p class="muted mb-0">Default aur apni personal categories manage karein.</p>
    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        + Add category
    </a>
</div>

<div class="row g-3">
    @foreach (['income' => 'Income', 'expense' => 'Expenses'] as $type => $heading)
        <div class="col-lg-6">
            <section class="panel">
                <h2 class="h5 fw-bold mb-3">{{ $heading }}</h2>

                @forelse ($categories->get($type, collect()) as $category)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                        <div>
                            <strong>{{ $category->name }}</strong>
                            <span class="badge text-bg-light">
                                {{ $category->user_id ? 'Personal' : 'Default' }}
                            </span>
                        </div>

                        @if ($category->user_id)
                            <div class="d-flex gap-2">
                                <a class="btn btn-sm btn-outline-secondary"
                                   href="{{ route('categories.edit', $category) }}">Edit</a>

                                <form method="POST"
                                      action="{{ route('categories.destroy', $category) }}"
                                      onsubmit="return confirm('Delete this personal category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="muted">No categories in this section.</p>
                @endforelse
            </section>
        </div>
    @endforeach
</div>
@endsection