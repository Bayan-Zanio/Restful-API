<x-admin-layout title="Class">
    <div class="container">
    <form action="{{  route('admin.user.update', $user->id)  }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('admin.user._form',[
        'button_label' =>'Update'
        ])

    </form>
    </div>
</x-admin-layout>