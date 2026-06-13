<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input name="name" value="{{ old('name', optional(optional($person)->user)->name) }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', optional(optional($person)->user)->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Password {{ $passwordRequired ? '' : '(leave empty to keep current)' }}</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Class</label>
        <select name="class_id" class="form-select @error('class_id') is-invalid @enderror">
            <option value="">No class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" @selected(old('class_id', optional($person)->class_id) == $class->id)>{{ $class->name }} - {{ $class->level }}</option>
            @endforeach
        </select>
        @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input name="phone" value="{{ old('phone', optional($person)->phone) }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input name="address" value="{{ old('address', optional($person)->address) }}" class="form-control @error('address') is-invalid @enderror">
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
