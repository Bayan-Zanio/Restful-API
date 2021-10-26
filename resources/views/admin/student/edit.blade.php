<x-admin-layout title="Class">

    <form action="{{  route('admin.student.update', $student->id)  }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('admin.student._form',[
        'button_label' =>'Update'
        ])

    </form>

</x-admin-layout>