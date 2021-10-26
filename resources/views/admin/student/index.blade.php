<x-admin-layout title="Class">


  <div class="row justify-content-center">
    <div class="container">
      <div class="table-toolbar mb-3">
        <a href="{{  route('admin.user.create')  }}" class="btn btn-info">Create</a>
      </div>
      <div class="row">


        <!-- course item -->
        @foreach ($student as $student)
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" height="200" width="200" src="{{asset('images/class.jpg')}}" alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i></li>
                <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                  <div class="d-flex align-items-center">
                    <i class="ti-alarm-clock text-primary icon-md mr-1"></i>

                </li>
              </ul>

              <h4 class="card-title"><a href="{{ url('/admin/student/student' , $student->id) }} ">{{ $student->seasons_name }}</a></h4>

              


              
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</x-admin-layout>