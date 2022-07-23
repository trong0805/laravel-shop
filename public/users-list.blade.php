@extends('admin.master')
@section('title', 'list users')
@section('content')
    <table class="table table-bordered">
        <a class="btn btn-primary" href="">Thêm mới</a>
        <thead>
            <tr>
                <th>TT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>date create</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($dataUser as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->email_verified_at }}</td>
                    <td>
                        <button href="" class="btn btn-primary">Update</button>
                        <form action="{{ route('users.delete', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    {{-- <div>
        {{ $dataUser->links() }}
    </div> --}}
@endsection
