<x-admin-layout title="Class">

    <div class="row justify-content-center">
        <div class="container">

            <div class="row">
                <form action="{{  route('admin.material.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('admin.material._form',[
                    'button_label' =>'Add'
                    ])

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>