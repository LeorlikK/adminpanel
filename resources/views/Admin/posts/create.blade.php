@extends('admin.layout.app')
@section('menu')
    @include('admin.layout.menu')
@endsection
@section('content')
        <form action="{{ route("admin.{$data['class_name']}.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Title" value="{{ old('title') }}" style="background: #222436">
                    <p class="text-danger">@error('title'){{ $message }}@enderror</p>
                </div>

                <div class="form-group">
                    <label for="summernote" style="background: #222436">Text</label>
                    <textarea class="form-control h-200" name="text" id="summernote" placeholder="Text" style="background: #222436">{{ old('text') }}</textarea>
                    <p class="text-danger">@error('text'){{ $message }}@enderror</p>
                </div>

                <div class="form-group">
                    <label for="exampleSelectRounded0" style="background: #222436">Category</label>
                    <select class="custom-select rounded-0" name="category_id" id="exampleSelectRounded0" style="background: #222436">
                        @foreach($data['categories'] as $category)
                            <option {{ $category->id == old('category_id') ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-danger">@error('category_id'){{ $message }}@enderror</p>
                </div>

                <div class="form-group" data-select2-id="29">
                    <label for="150" style="background: #222436">Tags</label>
                    <select class="select2 select2-hidden-accessible" id="150" name="tags_id[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%; background: #222436" data-select2-id="7" tabindex="-1" aria-hidden="true">
                        @foreach($data['tags'] as $tag)
                            <option {{ is_array(old('tags_id')) && in_array($tag->id, old('tags_id')) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select><span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select a State" style="width: 419.5px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    <p class="text-danger"><@error('tags_id'){{ $message }}@enderror/p>
                </div>

            </div>

            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
            <p class="text-danger">@error('image'){{ $message }}@enderror</p>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ url()->previous() === url()->current() ?  route("admin.{$data['class_name']}.index") : str_replace(url('/'), '', url()->previous()) }}"><button type="button" class="btn btn-dark btn-lg" style="background: #222436">Back</button></a>
                <button type="submit" class="btn btn-primary" style="margin-left: 90%; background: #222436">Submit</button>
            </div>
        </form>
@endsection
