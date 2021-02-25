            <div class="table-responsive p-1">
                <table id="classWiseStudentList" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>School</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>SMS Mobile</th>
                        <th>Student Id</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->roll_on }}</td>
                            <td>{{ $student->school_name }}</td>
                            <td>{{ $student->father_name }}</td>
                            <td>{{ $student->mother_name }}</td>
                            <td>{{ $student->sms_mobile }}</td>
                            <td>{{ $student->id }}</td>
                            {{-- <td><img src="{{  URL::to($slide->slide_image) }}" style="width: 150px;" alt="Slide Image"></td> --}}
                            <td>{{ $student->status == 1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                @if($student->status == 1)
                                <a href="{{-- {{ Route('slide-unpublish',['id'=>$slide->id]) }} --}}" title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                @else
                                <a href="{{-- {{ Route('slide-publish',['id'=>$slide->id]) }} --}}" title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                @endif

                                <a href="{{ Route('student-details',['id'=>$student->id]) }}" title="view" class="btn btn-sm btn-dark" target="_blank"><span class="fa fa-eye"></span></a>
                                
                                <a href="{{-- {{ Route('slide-edit',['id'=>$slide->id]) }} --}}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>

                                <a href="{{-- {{ Route('slide-delete',['id'=>$slide->id]) }} --}}" onclick="return confirm('if you want ot delete this item please press Ok')" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>   

<script>
    //Data Table Start
$(document).ready(function() {
    $('#classWiseStudentList').DataTable({
        fixedHeader:true
    });
} );
//Data Table End
</script>         