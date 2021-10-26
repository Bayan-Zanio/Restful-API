<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old ('name',$material->name) }}" class="form-control @error('name') is-invlaid @enderror">
    @error('name')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>