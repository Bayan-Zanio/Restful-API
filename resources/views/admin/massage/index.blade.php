<x-admin-layout title="Class">


<div class="row justify-content-center">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Massage</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($massage as $massage)
                        <tr>
                            <td>{{ $massage->id }}</td>
                            <td><a href="{{ url('/admin/massage/massages') }}">{{ $massage->name }}</a></td>
                            <td>{{ $massage->user->name }}</td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

   

</x-admin-layout>