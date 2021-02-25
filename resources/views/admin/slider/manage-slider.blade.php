@extends('admin.admin_layouts')
@section('admin_content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">

            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Manage Slide List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Slide Title</th>
                        <th>Slide Description</th>
                        <th>Slide Image</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                    	@foreach($slides as $row)
	                    <tr>
	                        <td>{{ $i++ }}</td>
	                        <td>{{ $row->slide_title }}</td>
	                        <td>{{ $row->slide_description }}</td>
	                        <td><img src="@if(isset($row->slide_image)){{ asset('/public/Slider/'.$row->slide_image) }} @else @endif " style="width: 150px;" alt="Slide Image"></td>
	                        <td>{{ $row->status == 1 ? 'Published' : 'Unpublished' }}</td>
	                        <td>
                                @if($row->status == 1)
                                    <a href="{{ Route('sliders.unpublish',['id'=>$row->id]) }}" title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                @else
	                                <a href="{{ Route('sliders.publish',['id'=>$row->id]) }}" title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                @endif
                                <a href="{{ Route('sliders.edit',$row->id) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                                <button type="button" class="btn btn-sm btn-danger" title="Delete">
                                    <i onclick="deleteItem({{ $row->id }})" class="fa fa-trash-alt"></i>
                                </button>
                                <form id="delete_form_{{ $row->id }}" method="POST" action="{{ route('sliders.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
	                        </td>
	                    </tr>
	                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->
@endsection