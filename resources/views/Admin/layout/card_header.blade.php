<tr>
    <th>
        <div class="card-header" style="background: #222436">
            <h3 class="card-title">{{ isset($data) && $data[$data['class_name']][0] ? strtoupper($data[$data['class_name']][0]->getTable()) : 'Null' }}
                {{ isset($data['request']['post_search']) ? ' search: ' : ' all: ' }} {{isset($data) && $data[$data['class_name']]->total()}}</h3>



                <div class="card-tools">

                    <form action="{{ route('admin.posts.index') }}" method="get">
                        <div class="form-group">
                            <label for="category-select">Select</label>
                            <select class="form-control" id="category-select" name="category_search">
                                <option @if (empty($data['request']['category_search'])) selected @endif value="{{ null }}">All</option>
                                @foreach( $data['categories'] as $category)
                                    <option @if (isset($data['request']['category_search']) && $data['request']['category_search'] == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">

                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="post_search" class="form-control float-right" placeholder="Search" value="{{
                                    $data['request']['post_search'] ?? ''}}" style="background: #222436">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default" style="background: #222436">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
        </div>
    </th>
</tr>

