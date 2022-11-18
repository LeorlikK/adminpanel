@extends('admin.layout.app')
@section('menu')
    @include('admin.layout.menu')
@endsection
@section('content')




    <div class="card-body">

        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $data[$data['class_name']]->category->name }}" READONLY style="background: #222436">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $data[$data['class_name']]->title }}" READONLY style="background: #222436">
        </div>

        <div class="form-group">
            <label for="textarea_id">Text</label>
            <textarea class="form-control" style="height: 200px; background: #222436" id="textarea_id" READONLY> {!! $data[$data['class_name']]->text !!} </textarea>
        </div>

        @php($string = '')
        @foreach($data[$data['class_name']]->tag as $cat_name)
            @php($data[$data['class_name']]->tag->last()->name == $cat_name->name ?  $string .= $cat_name->name . '' :  $string .= $cat_name->name . ',')
        @endforeach
        <div class="form-group">
            <label for="exampleInputEmail1">Tags</label>
            <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $string }}" READONLY style="background: #222436">
        </div>

        <label for="img_read">Image</label>
        <img class="w-25" src="{{ asset('/storage/' . $data[$data['class_name']]->image) }}" alt="Not image" id="img_read">

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="{{ url()->previous() === url()->current() ?  route("admin.{$data['class_name']}.index") : str_replace(url('/'), '', url()->previous()) }}"><button type="button" class="btn btn-dark btn-lg" style="background: #222436">Back</button></a>
    </div>
@endsection
