<thead>
    <tr>
        <th>Sl.</th>
        <th>Batch Name</th>
        <th>Student Capacity</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @php($i = 1)
    @foreach ($batches as $batch)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $batch->batch_name }}</td>
        <td>{{ $batch->student_capacity }}</td>
        <td>
            @if($batch->status == 1)
                <button onclick='unpublished("{{ $batch->id }}","{{ $batch->class_id }}")' title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></button>
            @else
                <button onclick='published("{{ $batch->id }}","{{ $batch->class_id }}")' title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></button >
            @endif
                <a href="{{ Route('batch-edit',['id'=>$batch->id]) }}" class="btn btn-sm btn-info" title="Edit" target="_blank"><span class="fa fa-edit"></span></a>
                <button onclick='batchdelete("{{ $batch->id }}","{{ $batch->class_id }}")' class="btn btn-sm btn-danger" title="Delete"><span class="fa fa-trash-alt"></span></button>
        </td>
    </tr>
    @endforeach
</tbody>

<script>
    function unpublished(batchId,classId) {
        var check = confirm("if you want unpublish this item, Press Ok");
        if (check) {
             $.get("{{ route('batch-unpublished') }}", {batch_id:batchId,class_id:classId}, function (data) {
                    console.log(data);
                    $("#batchList").html(data);
                })
        }
    }

    function published(batchId,classId) {
        $.get("{{ route('batch-published') }}", {batch_id:batchId,class_id:classId}, function (data) {
            console.log(data);
            $("#batchList").html(data);
        })
    }

    function batchdelete(batchId,classId) {
        var check = confirm("if you want delete this item, Press Ok");
        if (check) {
             $.get("{{ route('delete-batch') }}", {batch_id:batchId,class_id:classId}, function (data) {
                    console.log(data);
                    $("#batchList").html(data);
                })
        }
    }
</script>