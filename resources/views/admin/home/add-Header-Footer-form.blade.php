@extends('admin.admin_layouts')
@section('admin_content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content ">
        <div class="col-12 pl-0 pr-5">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Header Footer Add Form</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('header_footers.store') }}" autocomplete="on" class="form-inline">
                 @csrf
                <div class="form-group col-12 mb-3">
                    <label for="institute_name" class="col-sm-3 col-form-label text-right">Institute Name</label>
                    <input id="institute_name" type="text" class="col-sm-9 form-control @error('title') is-invalid @enderror" name="institute_name" value="{{ old('institute_name') }}" placeholder="Institute Name" required autocomplete="institute_name" autofocus>

                    @error('institute_name')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="title" class="col-sm-3 col-form-label text-right">Website Title</label>
                    <input id="name" type="text" class="col-sm-9 form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Website title" required autocomplete="title" autofocus>

                    @error('title')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="Address" class="col-sm-3 col-form-label text-right">Institute Address</label>
                    <input id="address" type="text" class="col-sm-9 form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Institute Address" required autocomplete="address" autofocus>

                    @error('address')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="mobile" class="col-sm-3 col-form-label text-right">Contact Number</label>
                    <input id="mobile" type="text" class="col-sm-9 form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" placeholder="8801xxxxxxxxx" required autocomplete="mobile" autofocus>

                    @error('mobile')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                
                <div class="form-group col-12 mb-3">
                    <label for="email" class="col-sm-3 col-form-label text-right">E-Mail Address</label>
                    <input id="email" type="email" class="col-sm-9 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>

                    @error('email')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label for="Copyright" class="col-sm-3 col-form-label text-right">Copyright By :</label>
                    <input id="copyright" type="text" class="col-sm-9 form-control @error('copyright') is-invalid @enderror" name="copyright" value="{{ old('copyright') }}" placeholder="Copyright &copy;" required autocomplete="copyright" autofocus>

                    @error('copyright')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Submit</button>
                </div>
                <input type="hidden" name="status" value="1">
            </form>
        </div>
    </div>
</section>
<!--Content End-->

@endsection