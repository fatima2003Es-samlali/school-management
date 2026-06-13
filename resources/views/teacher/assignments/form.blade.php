<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input name="title" value="{{ old('title', $assignment->title ?? '') }}" class="form-control @error('title') is-invalid @enderror">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Class</label>
        <select name="class_id" class="form-select @error('class_id') is-invalid @enderror">
            @foreach($classes as $class)
                <option value="{{ $class->id }}" @selected(old('class_id', $assignment->class_id ?? '') == $class->id)>{{ $class->name }} - {{ $class->level }}</option>
            @endforeach
        </select>
        @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Due date</label>
        <input type="date" name="due_date" value="{{ old('due_date', isset($assignment) ? $assignment->due_date->format('Y-m-d') : '') }}" class="form-control @error('due_date') is-invalid @enderror">
        @error('due_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">File / Link</label>
        <input name="file_link" value="{{ old('file_link', $assignment->file_link ?? '') }}" class="form-control @error('file_link') is-invalid @enderror">
        @error('file_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $assignment->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
