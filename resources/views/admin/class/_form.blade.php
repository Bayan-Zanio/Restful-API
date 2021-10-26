<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="seasons_name" value="{{ old ('seasons_name',$claas->seasons_name) }}" class="form-control @error('seasons_name') is-invlaid @enderror">
    @error('seasons_name')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>