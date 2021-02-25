                        
@if(count($studenttype)>0)
    @php($i=1)
    @foreach($studenttype as $student)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $student->class_name }}</td>
        <td>{{ $student->student_type }}</td>
        <td>{{ $student->status == 1 ? 'Published' : 'Unpublished' }}</td>
        <td>
            @if($student->status == 1)
            <button onclick="Unpublish('{{ $student->id }}')" title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></button>
            @else
            <button onclick="Publish('{{ $student->id }}')" title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></button>
            @endif
            <button onclick="StudentTypeEdit('{{ $student->id }}','{{ $student->student_type }}')" class="btn btn-sm btn-info" title="Edit"><span class="fa fa-edit"></span></button>
            <button onclick="StudentTypeDelete('{{ $student->id }}')" class="btn btn-sm btn-danger" title="Delete"><span class="fa fa-trash-alt"></span></button>
        </td>
    </tr>
    @endforeach
@else
    <tr class="text-danger">
        <td colspan="5">Student Type Not Found !!!</td>
    </tr>
@endif
