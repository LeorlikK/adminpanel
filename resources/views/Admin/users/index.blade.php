@extends('admin.layout.app')
@section('menu')
    @include('admin.layout.menu')
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            @include('admin.layout.card_header')
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Role</th>
                        <th>Avatar</th>
                        <th>Date Update</th>
                        <th>Date Create</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data[$data['class_name']] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ route("admin.{$data['class_name']}.show", [$item->id]) }}">{{ $item->email }}</a></td>
                        <td><a href="{{ route("admin.{$data['class_name']}.show", [$item->id]) }}">{{ $item->name }}</a></td>
                        <td><span class="tag tag-success">{{  $item->RoleUser()[$item->role] ?? 'Null' }}</span></td>
                        <td><img src="{{ asset("/storage/" . $item->avatar) }}" alt="User Avatar" class="img-size-50"></td>
                        <td><span class="tag tag-success">{{ $item->updated_at }}</span></td>
                        <td><span class="tag tag-success">{{ $item->created_at }}</span></td>

                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">

                                <a href="{{ route("admin.{$data['class_name']}.show", [$item->id]) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a href="{{ route("admin.{$data['class_name']}.edit", [$item->id]) }}" class="btn btn-info"><i class="fas fa-recycle"></i></a>
                                <form action="{{ route("admin.{$data['class_name']}.destroy", $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"><i class="fas fa-trash text-danger border-0 bg-transparent"  role="button"></i></button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.layout.pagination_and_create')
@endsection
