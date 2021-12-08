@extends('admin.admin_layouts')
@section('admin_content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">

            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">All Running Student List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Class</th>
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
	                        <td>{{ $student->class_name }}</td>
                            <td>{{ $student->school_name }}</td>
                            <td>{{ $student->father_name }}</td>
                            <td>{{ $student->mother_name }}</td>
                            <td>{{ $student->sms_mobile }}</td>
                            <td>{{ $student->id }}</td>
	                        <td>{{ $student->status == 1 ? 'Published' : 'Unpublished' }}</td>
	                        <td>
                                @if($student->status == 1)
                                    <a href="{{ Route('student.unpublish',['id'=>$student->id]) }}" title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                @else
                                    <a href="{{ Route('student.publish',['id'=>$student->id]) }}" title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                @endif

                                <a href="{{ Route('student-details',['id'=>$student->id]) }}" title="view" class="btn btn-sm btn-dark" target="_blank"><span class="fa fa-eye"></span></a>

	                            <a href="{{-- {{ Route('slide-delete',['id'=>$slide->id]) }} --}}" onclick="return confirm('if you want ot delete this item please press Ok')" class="btn btn-sm btn-danger"><span class="fa fa-trash-alt"></span></a>
	                        </td>
	                    </tr>
	                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->



@endsection
