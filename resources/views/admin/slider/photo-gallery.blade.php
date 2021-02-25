@extends('admin.admin_layouts')
@section('admin_content')
<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <h2 class="text-center font-weight-bold font-italic mt-3">Our Gallery</h2>
        </div>
        @foreach($slides as $slide)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 pl-0 pr-0">
            <a class="image-link" href="
            @if(isset($slide->slide_image)){{ asset('/public/Slider/'.$slide->slide_image) }} @else @endif
            "><img class="img-thumbnail" src="
            @if(isset($slide->slide_image)){{ asset('/public/Slider/'.$slide->slide_image) }} @else @endif
            " alt="Photo Gallery"></a>
        </div>
        @endforeach
    </div>
</section>
<!--Content End-->

@endsection