<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>Title</th><th>Author</th><th>Category</th><th>Status</th>@if($admin)<th class="text-end">Actions</th>@endif</tr></thead>
        <tbody>
        @forelse($books as $book)
            <tr>
                <td>
                    <strong>{{ $book->title }}</strong>
                    <div class="small text-muted">{{ $book->description }}</div>
                </td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category }}</td>
                <td><span class="badge text-bg-{{ $book->available ? 'success' : 'secondary' }}">{{ $book->available ? 'Available' : 'Unavailable' }}</span></td>
                @if($admin)
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.books.edit', $book) }}">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Delete this book?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        @empty
            <tr><td colspan="{{ $admin ? 5 : 4 }}" class="text-center text-muted">No books found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $books->links() }}
