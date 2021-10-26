<x-admin-layout title="Class">


    <div class="row justify-content-center">

        <div class="container">

            <div class="row">
                <!-- course item -->

                <div class="col-lg-6 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <a href="{{ route('admin.class.index') }}">
                            <img class="card-img-top rounded-0" height="200" width="200" src="{{asset('images/h1.jpeg')}}" alt="course thumb">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <a href="{{ route('admin.student.index') }}">
                            <img class="card-img-top rounded-0" height="200" width="200" src="{{asset('images/h2.jpeg')}}" alt="course thumb">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <a href="{{ route('admin.massage.massage') }}">
                            <img class="card-img-top rounded-0" height="200" width="200" src="{{asset('images/h3.jpeg')}}" alt="course thumb">
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 mb-5">
                    <div class="card p-0 border-primary rounded-0 hover-shadow">
                        <a href="{{ route('admin.teacher.index') }}">
                            <img class="card-img-top rounded-0" height="200" width="200" src="{{asset('images/h4.jpeg')}}" alt="course thumb">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layout>