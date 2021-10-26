<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old ('name',$user->name) }}" class="form-control @error('name') is-invlaid @enderror">
    @error('name')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>


<div class="form-group mb-3">
    <label for="">email:</label>
    <input type="email" name="email" value="{{ old ('email',$user->email) }}" class="form-control @error('email') is-invlaid @enderror">
    @error('email')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>


<div class="form-group mb-3">
    <label for="">password:</label>
    <input type="password" name="password" value="{{ old ('email',$user->password) }}" value="FakePSW" id="myInput" class="form-control @error('password') is-invlaid @enderror">
    <input type="checkbox" onclick="myFunction()">Show Password
    @error('password')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">phone:</label>
    <input type="number" name="phone" value="{{ old ('phone',$user->phone) }}" class="form-control @error('phone') is-invlaid @enderror">
    @error('phone')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">Class:</label>
    <select multiple id="claas_id" name="claas_id[]" class="form-control @error('claas_id') is-invlaid @enderror">
        <option value="">Select Class</option>
        

        @foreach($claas as $tag)
        <option {{ in_array($tag->id,$tagsSelected) ? 'selected' : ''}} value="{{ $tag->id }}">
            {{ $tag->seasons_name }}
        </option>
        @endforeach

    </select>
    @error('claas_id')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">material:</label>
    <select multiple id="material_id" name="material_id[]" class="form-control @error('material_id') is-invlaid @enderror">
        <option value="">Select materiales</option>


        @foreach($material as $tag)
        <option {{ in_array($tag->id,$tagsSelected) ? 'selected' : ''}} value="{{ $tag->id }}">
            {{ $tag->name }}
        </option>
        @endforeach


    </select>
    @error('material_id')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>


<div class="form-group mb-3">
    <label for="">Image:</label>
    <div class="mb-2">
        <img src=" {{ $user->image_url }} " height="50" alt="">
    </div>
    <input type="file" name="image" class="form-control @error('image') is-invlaid @enderror">
    @error('image')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">address:</label>
    <input type="text" name="address" value="{{ old ('address',$user->address) }}" class="form-control @error('address') is-invlaid @enderror">
    @error('address')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="">date_of_birth:</label>
    <input type="date" name="date_of_birth" value="{{ old ('date_of_birth',$user->date_of_birth) }}" class="form-control @error('date_of_birth') is-invlaid @enderror">
    @error('date_of_birth')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>


<div class="form-group mb-3">
    <label for="">type:</label>
    <select name="type" class="form-control @error('type') is-invlaid @enderror">
        <option value="{{ old ('type',$user->type) }}">{{$user->type}}</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>

    </select>
    @error('type')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>




<div class="form-group mb-3">
    <label for="">gender:</label>
    <select id="as" name="gender" class="form-control @error('gender') is-invlaid @enderror">
        <option value="{{ old ('address',$user->gender) }}">{{$user->gender}}</option>
        <option value="male">male</option>
        <option value="female">female</option>

    </select>
    @error('gender')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>

@push('script')
<script>
    $(function() {
        $('select').selectize({
            maxItems: 3,
        });
    });
</script>
@endpush

<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>