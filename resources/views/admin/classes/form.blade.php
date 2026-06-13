<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input name="name" value="{{ old('name', $class->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Level</label>
        <input name="level" value="{{ old('level', $class->level ?? '') }}" class="form-control @error('level') is-invalid @enderror">
        @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $class->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
