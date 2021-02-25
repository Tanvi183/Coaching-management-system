<div class="form-group col-md-6 mb-3">
  <label for="classId" class="col-sm-4 col-form-label text-right">Class Name</label>
    <select name="class_id" class="form-control col-sm-8" id="classId" required>
        <option value="">--Select Class</option>
        @foreach($classes as $class)
            <option value="{{ $class->id }}" {{ $class->id == $data->class_id ? 'Selected' : '' }}>{{ $class->class_name }}</option>
        @endforeach
    </select>
    <span class="text-danger"></span> 
</div>

<div class="form-group col-md-6 mb-3">
    <label class="col-sm-4 col-form-label text-right">Student Type</label>
    <div class="col-sm-8" id="type" name="type_id">
    	@if(count($types)>0)
			@foreach($types as $type)
			<input type="checkbox" name="student_type[{{ $type->id }}]" value="{{ $type->id }}" id="studentType-{{ $type->id }}" class="mr-2" />{{ $type->student_type }}
			@endforeach
		@else
			<span class="text-danger">Please Add Some Type First</span>
		@endif
    </div>
</div>


@foreach($types as $type)
<div class="col-12" id="batchRollInfo-{{ $type->id }}"></div>
@endforeach


<script>
	@foreach($types as $type)
	$('#studentType-{{ $type->id }}').change(function(){
		var typeId = $(this).val();
		if ($(this).prop('checked')){
			var classId = $('#classId').val();
			if (classId && typeId) {
				$.get("{{ route('batch-roll-form') }}",{
					class_id:classId,
					type_id:typeId,
				},function (data) {
					$('#batchRollInfo-'+typeId).empty().html(data);
					console.log(data);
				});
			}
		}else{
			$('#batchRollInfo-'+typeId).empty();
		}
	})
	@endforeach


	$('#classId').change(function () {
        var classId = $(this).val();
        if (classId) {
            $.get("{{ route('bring-student-type') }}",{ 
                class_id:classId 
            },function(data){
                    console.log(data);
                    $('#batchInfo').empty().html(data)
                })
        }
    });
</script>