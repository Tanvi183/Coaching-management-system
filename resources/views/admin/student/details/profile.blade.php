@extends('admin.admin_layouts')
@section('admin_content')

    <div class="row">
        <div class="col-12 pl-0 pr-0 content">

            <div class="form-group">

                <div class="row ml-5 mr-2">
                    <div class="col-md-3">
                       <h4 class="text-center font-weight-bold pt-3">{{ $students[0]->student_name }}'s Profile</h4>

                        <img src="@if(isset($students[0]->student_photo)){{ asset($students[0]->student_photo) }} @else {{ asset('/admin/assets/images/avatar.png') }} @endif" style="width: 100%" alt="Profile Picture">

                        <hr>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <button data-toggle="modal" data-target="#studentBasicInfoUpdate" class="btn btn-block my-btn-submit">Edit Profile</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-9">
                        @include('admin.student.details.basic-info')
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- model --}}
    @include('admin.student.details.models.basic-info-update')

@endsection
