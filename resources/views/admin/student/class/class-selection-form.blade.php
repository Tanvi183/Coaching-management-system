@extends('admin.admin_layouts')
@section('admin_content')
    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 ml-0 mr-0">

            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Class Wise Student List</h4>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col">
                        <select name="class_id" class="form-control" id="classId">
                            <option value="">--Select Class--</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="type_id" class="form-control" id="typeId">
                            <option value="">--Select Course--</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" id="studentList"></table>
            </div>

        </div>
    </div>
</section>

<!--Content End-->



                

<style>#overlay .loader{display: none}</style>
@include('admin.includes.loader')

<script>
    $('#classId').change(function () {
        var classId = $(this).val();
        if (classId) {
            $('#overlay .loader').show();
            $.get("{{ route('class-wise-student-type') }}",{class_id: classId},function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#typeId').empty().html(data);
            })
        }else{
            $('#typeId').empty().html('<option value="">--Select Class--</option>');
        }
    });

    $('#typeId').change(function () {
        var classId = $('#classId').val();
        var typeId = $(this).val();

            if (classId && typeId) {
                $('#overlay .loader').show();
                $.get("{{ route('class-and-type-wise-student') }}", {
                    class_id:classId,
                    type_id:typeId,
                }, function (data) {
                    console.log(data);
                    $('#overlay .loader').hide();
                    $('#studentList').empty().html(data);
                })
            }else{
                $('#studentList').empty();
            }
        })
</script>
@endsection