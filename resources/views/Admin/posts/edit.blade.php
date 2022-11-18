@extends('admin.layout.app')
@section('menu')
    @include('admin.layout.menu')
@endsection
@section('content')
    <form action="{{ route('admin.posts.update', [$data[$data['class_name']]->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Title" value="{{ $data[$data['class_name']]->title }}" style="background: #222436">
                <p class="text-danger">@error('title'){{ $message }}@enderror</p>
            </div>

            <div class="form-group">
                <label for="summernote">Text</label>
                <textarea class="form-control h-200" name="text" id="summernote" placeholder="Text" style="background: #222436">{!! $data[$data['class_name']]->text !!}</textarea>
                <p class="text-danger">@error('text'){{ $message }}@enderror</p>
            </div>

            <div class="form-group">
                <label for="exampleSelectRounded0">Category</label>
                <select class="custom-select rounded-0" name="category_id" id="exampleSelectRounded0" style="background: #222436">
                    @foreach($data['categories'] as $item)
                        <option {{ $item->id === $data[$data['class_name']]->category_id ? 'selected' : '' }} value="{{ $item->id }}" >{{ $item->name }}</option>
                    @endforeach
                </select>
                <p class="text-danger">@error('category_id'){{ $message }}@enderror</p>
            </div>

            <div class="form-group" data-select2-id="29">
                <label for="150">Tags</label>
                <select class="select2 select2-hidden-accessible" id="150" name="tags_id[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%; background: #222436" data-select2-id="7" tabindex="-1" aria-hidden="true">
                    @foreach($data['tags'] as $tag)
                        <option {{ is_array($data[$data['class_name']]->tag->pluck('id')->toArray()) && in_array($tag->id, $data[$data['class_name']]->tag->pluck('id')->toArray()) ? 'selected' : ''}} value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select><span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select a State" style="width: 419.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                <p class="text-danger"><@error('tags_id'){{ $message }}@enderror/p>
            </div>

            <img class="w-25" src="{{ asset('/storage/' . $data[$data['class_name']]->image) }}" alt="Not image">

            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile" style="background: #222436">
                        <label class="custom-file-label" for="exampleInputFile" style="background: #222436">{{ $data[$data['class_name']]['image'] }}</label>
                    </div>
                    <div class="input-group-append" style="background: #222436">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ url()->previous() === url()->current() ?  route("admin.{$data['class_name']}.index") : str_replace(url('/'), '', url()->previous()) }}"><button type="button" class="btn btn-dark btn-lg" style="background: #222436">Back</button></a>
            <button type="submit" class="btn btn-primary" style="margin-left: 90%; background: #222436">Submit</button>
        </div>
    </form>
@endsection
