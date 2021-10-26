<x-admin-layout title="Class">

    <form action="{{  route('admin.class.update', $id)  }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('admin.class._form',[
        'button_label' =>'Update'
        ])

    </form>

</x-admin-layout>