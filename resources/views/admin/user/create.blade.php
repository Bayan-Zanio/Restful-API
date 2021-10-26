<x-admin-layout title="Class">
    <div class="container">
        <form action="{{  route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            @include('admin.user._form',[
            'button_label' =>'Add'
            ])

        </form>
    </div>
  
</x-admin-layout>