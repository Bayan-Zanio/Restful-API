<x-admin-layout title="Class">

    <div class="row justify-content-center">
        <div class="container">
            <div class="table-toolbar mb-3">
                <a href="{{  route('admin.class.create')  }}" class="btn btn-info">Create</a>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parents as $parents)
                        <tr>
                            <td>{{ $parents->id }}</td>
                            <td><a href="{{  route('admin.class.edit',[$parents->id])  }}">{{ $parents->seasons_name }}</a></td>
                            <td>{{ $parents->created_at }}</td>

                            <td>
                                {{-- @if (Auth::user()->can('delete' , $parents)) --}}

                                <form action="{{  route('admin.class.destroy',[$parents->id])  }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>

                            </td>
                            <td>
                                <div class="table-toolbar mb-3">
                                    <a href="{{ route('admin.user.edit',[$parents->id])   }}" class="btn btn-sm btn-info">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-admin-layout>