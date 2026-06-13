<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input name="title" value="{{ old('title', $book->title ?? '') }}" class="form-control @error('title') is-invalid @enderror">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Author</label>
        <input name="author" value="{{ old('author', $book->author ?? '') }}" class="form-control @error('author') is-invalid @enderror">
        @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <input name="category" value="{{ old('category', $book->category ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="available" value="1" class="form-check-input" id="available" @checked(old('available', $book->available ?? true))>
            <label for="available" class="form-check-label">Available</label>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $book->description ?? '') }}</textarea>
    </div>
</div>
