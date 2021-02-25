@extends('admin.master')
@section('main-content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Batch Edit Form</h4>
                    </div>
                </div>

                <form action="{{ route('batch-update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="table-responsive p-1">
                        <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="classId" class="col-form-label col-sm-3 text-right">Class Name</label>
                                        <div class="col-sm-9">

                                           <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" id="classId" required autofocus>
                                                <option value="">--Select Class--</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" {{ $class->id == $batch->class_id ? "Selected" : "" }} >{{ $class->class_name }}</option>
                                                @endforeach
                                           </select>

                                            @error('class_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="typeId" class="col-form-label col-sm-3 text-right">Student Type</label>
                                        <div class="col-sm-9">

                                           <select name="type_id" class="form-control @error('type_id') is-invalid @enderror" id="typeId" required >
                                                <option value="">--Select StudentType--</option>
                                           </select>

                                            @error('type_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="BatchName" class="col-form-label col-sm-3 text-right">Batch Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('batch_name') is-invalid @enderror" name="batch_name" value="{{ $batch->batch_name }}" id="BatchName" placeholder="Write Batch Name here" required>
                                            @error('batch_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="StudentCapacity" class="col-form-label col-sm-3 text-right">Student Capacity</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control @error('student_capacity') is-invalid @enderror" name="student_capacity" value="{{ $batch->student_capacity }}" id="StudentCapacity" placeholder="Write  Student Capacity Here." required>
                                            @error('student_capacity')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <input type="hidden" name="batch_id" value="{{ $batch->id }}">

                            <tr><td><button type="submit" class="btn btn-block my-btn-submit">Update</button></td></tr>
                        </table>
                    </div>
                </form>
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
            $.get("{{ route('class-wise-student-type') }}",{ class_id:classId },function(data){
                $('#overlay .loader').hide();
                    console.log(data);
                    $('#typeId').empty().html(data);
                });
        }else{
            $('#typeId').empty().html('<option value="">--Select StudentType--</option>');
        }
    })
</script>

@endsection