@extends('admin.admin_layouts')
@section('admin_content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content ">
        <div class="col-12 pl-0 pr-5">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Update Header Footer Form</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('header_footers.update', $headerFooter->id) }}" autocomplete="on" class="form-inline">
                @method('PUT')
                @csrf
                <div class="form-group col-12 mb-3">
                    <label for="institute_name" class="col-sm-3 col-form-label text-right">Institute Name</label>
                    <input id="institute_name" type="text" class="col-sm-9 form-control @error('title') is-invalid @enderror" name="institute_name" value="{{ $headerFooter->institute_name }}" required autocomplete="institute_name" autofocus>
                    @error('institute_name')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="title" class="col-sm-3 col-form-label text-right">Website Title</label>
                    <input id="name" type="text" class="col-sm-9 form-control @error('title') is-invalid @enderror" name="title" value="{{ $headerFooter->title }}" required autocomplete="title" autofocus>
                    @error('title')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="Address" class="col-sm-3 col-form-label text-right">Institute Address</label>
                    <input id="address" type="text" class="col-sm-9 form-control @error('address') is-invalid @enderror" name="address" value="{{ $headerFooter->address }}" required autocomplete="address" autofocus>
                    @error('address')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="mobile" class="col-sm-3 col-form-label text-right">Contact Number</label>
                    <input id="mobile" type="text" class="col-sm-9 form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $headerFooter->mobile }}" required autocomplete="mobile" autofocus>
                    @error('mobile')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="email" class="col-sm-3 col-form-label text-right">E-Mail Address</label>
                    <input id="email" type="email" class="col-sm-9 form-control @error('email') is-invalid @enderror" name="email" value="{{ $headerFooter->email }}" required autocomplete="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label for="Copyright" class="col-sm-3 col-form-label text-right">Copyright By :</label>
                    <input id="copyright" type="text" class="col-sm-9 form-control @error('copyright') is-invalid @enderror" name="copyright" value="{{ $headerFooter->copyright }}" placeholder="Copyright By :" required autocomplete="copyright" autofocus>
                    @error('copyright')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->

@endsection