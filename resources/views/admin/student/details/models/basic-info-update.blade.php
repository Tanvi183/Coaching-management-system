    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="studentBasicInfoUpdate" tabindex="-1" role="dialog" aria-labelledby="studentBasicInfoUpdateTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="studentBasicInfoUpdateTitle">Student Basic Information Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{ route('basic-info-update') }}" method="post" id="studentTypeUpdate" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

            <div class="form-group row ">
                <label for="studentName" class="col-form-label col-sm-3 text-right">Student Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('student_name') is-invalid @enderror" name="student_name" id="studentName" value="{{ $students[0]->student_name }}" required>
                    @error('student_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="schoolName" class="col-form-label col-sm-3 text-right">School Name</label>
                <div class="col-sm-9">
                  <select name="school_id" class="form-control @error('school_name') is-invalid @enderror" name="school_name" id="schoolName" id="school" required>
                    <option value="">Select School</option>
                    @foreach($schools as $school)
                      <option value="{{ $school->id }}" {{ $students[0]->school_id == $school->id ? 'selected' : '' }}>{{ $school->school_name }}</option>
                    @endforeach
                    <span class="text-danger"></span>
                  </select> 

                    @error('school_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="fatherName" class="col-form-label col-sm-3 text-right">Father's Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" id="fatherName" value="{{ $students[0]->father_name }}" required>
                    @error('father_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="motherName" class="col-form-label col-sm-3 text-right">Mother's Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" id="motherName" value="{{ $students[0]->mother_name }}" required>
                    @error('mother_name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="emailAddress" class="col-form-label col-sm-3 text-right">Email Address</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control @error('email_address') is-invalid @enderror" name="email_address" id="emailAddress" value="{{ $students[0]->email_address }}" required>
                    @error('email_address')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="smsMobile" class="col-form-label col-sm-3 text-right">SMS Mobile No.</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('sms_mobile') is-invalid @enderror" name="sms_mobile" id="smsMobile" value="{{ $students[0]->sms_mobile }}" required>

                    <input type="hidden" name="old_image" value="{{ $students[0]->student_photo }}">

                    @error('sms_mobile')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="" class="col-form-label col-sm-3 text-right"></label>
                <div class="col-sm-9">
                  <img class="img-thumbnail" src="@if(isset($students[0]->student_photo)){{ asset($students[0]->student_photo) }} @else {{ asset('/admin/assets/images/avatar.png') }} @endif" alt="Student Photo" id="studentPhoto" style="max-width: 50%;">
                </div>
            </div>

            <div class="form-group row ">
                <label for="studentPhoto" class="col-form-label col-sm-3 text-right">Student Photo</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control @error('student_photo') is-invalid @enderror" name="student_photo" id="photo" onchange="showImage(this, 'studentPhoto')">
                    @error('student_photo')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row ">
                <label for="Address" class="col-form-label col-sm-3 text-right">Address</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="Address" value="{{ $students[0]->address }}" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>


            <input type="hidden" name="student_id" value="{{ $students[0]->id }}"/>

        </div>
        <div class="modal-footer">
          {{-- <button type="reset" class="d-none" data-dismiss="modal" id="reset">Reset</button> --}}
          <button type="submit" class="btn btn-block my-btn-submit">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>
