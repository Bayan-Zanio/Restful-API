<x-admin-layout title="Class">

    <div class="row justify-content-center">
        <div class="container">
            <div class="table-toolbar mb-3">
                <a href="{{  route('admin.material.create')  }}" class="btn btn-info">Create</a>
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
                        @foreach ($material as $parents)
                        <tr>
                            <td>{{ $parents->id }}</td>
                            <td>{{ $parents->name }}</td>
                            <td>{{ $parents->created_at }}</td>

                            <td>
                                {{-- @if (Auth::user()->can('delete' , $parents)) --}}

                                <form action="{{  route('admin.material.destroy',[$parents->id])  }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-admin-layout>