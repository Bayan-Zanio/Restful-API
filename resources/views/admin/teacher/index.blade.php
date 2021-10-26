<x-admin-layout title="Class">





  <div class="row justify-content-center">
    <div class="container">
      <div class="table-toolbar mb-3">
        <a href="{{  route('admin.user.create')  }}" class="btn btn-info">Create</a>
      </div>
      <div class="row">


        <!-- course item -->
        @foreach ($user as $user)
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" height="200" width="200" src="{{ $user->image_url }}" alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i></li>
                <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                  <div class="d-flex align-items-center">
                    <i class="ti-alarm-clock text-primary icon-md mr-1"></i>

                </li>
              </ul>
              <a href="">
                <h4 class="card-title">{{ $user->name }}</h4>
              </a>
              <a href="">
                <h4 class="card-title d-inline">@foreach($user->claas as $class)
                  {{$class->seasons_name}},
                  @endforeach
                </h4>
              </a>
              <div class="toolbar mt-3 mb-3">
                <a href="{{ route('admin.user.edit',[$user->id])   }}" class="btn btn-sm btn-info">Edit</a>

                <form class="d-inline" action="{{  route('admin.user.destroy',[$user->id])  }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</x-admin-layout>