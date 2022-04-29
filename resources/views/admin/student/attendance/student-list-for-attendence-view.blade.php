<div class="table-responsive p-1">
    <table id="classWiseStudentList" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Name</th>
            <th>Roll</th>
            <th>School</th>
            <th>SMS Mobile</th>
            <th>Student Id</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach($allData as $data)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $data->student_name }}</td>
                <td>{{ $data->roll_on }}</td>
                <td>{{ $data->school_name }}</td>
                <td>{{ $data->sms_mobile }}</td>
                <td>{{ $data->id }}</td>
                <td>
                    <span class="badge badge-{{ $data->attendance == 1 ? 'success' : 'danger' }} p-2">{{ $data->attendance == 1 ? 'Present' : 'Absent' }}</span>
                </td>
            </tr>
            @endforeach
            @if(count($allData)>0)
                <tr>
                    <td colspan="7">
                        <button type="submit" class="btn btn-block my-btn-submit">Submit Attendance</button>
                    </td>
                </tr>
            @endif
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
