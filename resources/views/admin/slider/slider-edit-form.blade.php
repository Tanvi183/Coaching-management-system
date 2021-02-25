@extends('admin.admin_layouts')
@section('admin_content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">Slide Edit Form</h4>
                    </div>
                </div>

                <form action="{{ route('sliders.update', $slides->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="table-responsive p-1">
                        <table id="" class="table table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                            <tr><td><img src="@if(isset($slides->slide_image)){{ asset('/public/Slider/'.$slides->slide_image) }} @else @endif " alt="" id="slide_show" style="max-height: 244px"></td></tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="slide_image" id="slideImage" onchange="showImage(this, 'slide_show')">
                                            <label class="custom-file-label" for="inputGroupFile02" id="fileLabel">Choose file</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="slideTitle" class="col-form-label col-sm-3 text-right">Slide Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('slide_title') is-invalid @enderror" name="slide_title" value="{{ $slides->slide_title }}" id="slideTitle" placeholder="Write slide title here" >
                                            @error('slide_title')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label class="col-form-label col-sm-3 text-right" for="slideDescription">Slide Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('slide_description') is-invalid @enderror" name="slide_description" id="slideDescription" placeholder="Write slide description here" value="{{ $slides->slide_description }}" >
                                            @error('slide_description')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-group row mb-0">
                                        <label for="description" class="col-form-label col-sm-3 text-right" for="title">Publication Status</label>
                                        <div class="col-sm-9 text-left">
                                            <div class="form-check col-form-label">
                                                <input class="form-check-input" type="radio" name="status" value="1" {{ $slides->status == 1 ? 'checked' : ''}} >
                                                <label class="form-check-label">Published</label>
                                            </div>
                                            <div class="form-check col-form-label">
                                                <input class="form-check-input" type="radio" name="status" value="2" {{ $slides->status == 2 ? 'checked' : ''}} >
                                                <label class="form-check-label">Unpublished</label>
                                            </div>
                                            @error('publication_status')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr><td><button type="submit" class="btn btn-block my-btn-submit">Updated</button></td></tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--Content End-->
@endsection