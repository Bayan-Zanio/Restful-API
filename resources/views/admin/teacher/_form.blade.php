<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old ('name',$teacher->name) }}" class="form-control @error('name') is-invlaid @enderror">
    @error('name')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Class:</label>
    <select name="seasons_name" class="form-control @error('seasons_name') is-invlaid @enderror">
        <option value="">Select Class</option>
        @foreach ($season as $class)
        <option value="{{ $class->id }}" @if($class->id==old('seasons_name',$teacher->seasons_name)) selected @endif>{{ $class->seasons_name }}</option>
        @endforeach
    </select>
    @error('seasons_name')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Email:</label>
    <select name="email" class="form-control @error('email') is-invlaid @enderror">
        <option value="">Select Email</option>
        @foreach ($user as $user)
        <option value="{{ $user->id }}" @if($user->id==old('email',$teacher->email)) selected @endif>{{ $user->email }}</option>
        @endforeach
    </select>
    @error('email')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">phone</label>
    <textarea name="phone" class="form-control @error('phone') is-invlaid @enderror">{{ old('phone',$teacher->phone) }}</textarea>
    @error('phone')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Image:</label>
    <div class="mb-2">
        <img src=" {{ $teacher->image_url }} " height="100" alt="">
    </div>
    <input type="file" name="image" class="form-control @error('image') is-invlaid @enderror">
    @error('image')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>



<div class="form-group mb-3">
    <label for="">address:</label>
    <input type="text" name="address" value="{{ old ('address',$teacher->address) }}" class="form-control @error('address') is-invlaid @enderror">
    @error('address')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">date_of_birth:</label>
    <input type="date_of_birth" name="date_of_birth" value="{{ old ('date_of_birth',$teacher->date_of_birth) }}" class="form-control @error('date_of_birth') is-invlaid @enderror">
    @error('date_of_birth')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>


<div class="form-group mb-3">
    <label>gender</label>
</div>
<div class="form-group mb-3">
    <label>
        <input type="radio" name="gender" value="male" @if(old( 'gender' , $teacher->gender) == 'male' ) checked @endif >male
    </label>
    <label>
        <input type="radio" name="gender" value="female" @if(old( 'gender' , $teacher->gender) == 'female' )checked @endif >female
    </label>
</div>
@error('gender')
<p class="invalid-feedback d-block d-block">{{ $message }}</p>
@enderror
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>