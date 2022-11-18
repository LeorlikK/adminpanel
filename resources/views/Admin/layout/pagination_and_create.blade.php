<div>
    {{$data[$data['class_name']]->withQueryString()->onEachSide(2)->links()}}
    <a  href="{{ route("admin.{$data['class_name']}.create") }}"><button type="button" class="btn  btn-info" style="position: relative; left: 1560px; background: #222436">Create</button></a>
</div>
