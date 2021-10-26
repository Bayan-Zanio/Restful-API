<x-admin-layout title="Class">

    <form action="{{  route('admin.teacher.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('admin.teacher._form',[
        'button_label' =>'Add'
        ])

    </form>

</x-admin-layout>