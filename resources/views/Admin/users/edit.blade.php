@extends('admin.layout.app')
@section('menu')
    @include('admin.layout.menu')
@endsection
@section('content')
    <form action="{{ route("admin.{$data['class_name']}.update", [$data[$data['class_name']]->id, 'page=' . $page]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input name="login" type="text" class="form-control" id="exampleInputEmail1" placeholder="Login" value="{{ $data[$data['class_name']]->name }}">
                <p class="text-danger">@error('login'){{ $message }}@enderror</p>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{ $data[$data['class_name']]->email }}">
                <p class="text-danger">@error('email'){{ $message }}@enderror</p>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">New Password</label>
                <input name="password" type="text" class="form-control" id="exampleInputEmail1" placeholder="New Password" value="{{ old('password') }}">
                <p class="text-danger">@error('password'){{ $message }}@enderror</p>
            </div>
            <div class="form-group">
                <label for="exampleInputRole">Role</label>
                <select class="custom-select rounded-0" name="role" id="exampleInputRole">
                    <option value="{{ '' }}">Not role</option>
                    @foreach($data['role'] as $role_id => $role_name)
                        <option value="{{ $role_id }}"
                        {{ $role_id === $data[$data['class_name']]->role ? 'selected' : '' }}

                        >{{ $role_name }}</option>
                    @endforeach
                </select>
                <p class="text-danger">@error('role_id'){{ $message }}@enderror</p>
            </div>

            <input name="user_id" type="hidden" id="exampleInputEmail1"  value="{{ $data[$data['class_name']]->id}}">


            <img class="w-25" src="{{ asset('storage/' . $data[$data['class_name']]->avatar) }}" alt="Not image">

            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="avatar" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            <p>@error('avatar'){{ $message }}@enderror</p>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ url()->previous() === url()->current() ?  route("admin.{$data['class_name']}.index") : str_replace(url('/'), '', url()->previous()) }}"><button type="button" class="btn btn-dark btn-lg">Back</button></a>
            <button type="submit" class="btn btn-primary" style="margin-left: 90%">Submit</button>
        </div>
    </form>
@endsection
