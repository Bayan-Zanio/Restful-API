<x-admin-layout title="Class">

    <form action="{{  route('admin.teacher.update', $teacher->id)  }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('admin.teacher._form',[
        'button_label' =>'Update'
        ])

    </form>

</x-admin-layout>