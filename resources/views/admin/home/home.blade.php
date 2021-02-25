@extends('admin.admin_layouts')
@section('admin_content')

<!--Slider Start-->
<section class="container-fluid">
    <div class="row">
        <div class="col-12 pl-0 pr-0">
            <div class="owl-carousel">
                @foreach($slides as $slide)
                <div class="item">
                    <img src="@if(isset($slide->slide_image)){{ asset('/public/Slider/'.$slide->slide_image) }} @else @endif " alt="Slide Image">
                    <div class="slide-caption">
                        <h2>{{ $slide->slide_title }}</h2>
                        <p>{{ $slide->slide_description }}</p>
                    </div>
                </div>
                 @endforeach
            </div>
        </div>
    </div>
</section>
<!--Slider End-->

@endsection