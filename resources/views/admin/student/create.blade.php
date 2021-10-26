<x-admin-layout title="Class">

    <form action="{{  route('admin.student.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('admin.student._form',[
        'button_label' =>'Add'
        ])

    </form>

</x-admin-layout>