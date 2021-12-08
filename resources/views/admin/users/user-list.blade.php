@extends('admin.admin_layouts')
@section('admin_content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">User List</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                    	@foreach($users as $row)
	                    <tr>
	                        <td>{{ $i++ }}</td>
	                        <td>{{ $row->role }}</td>
	                        <td>{{ $row->name }}</td>
	                        <td>{{ $row->mobile }}</td>
	                        <td>{{ $row->email }}</td>
	                        <td>
	                            <a href="{{ route('users.show', $row->id) }}" class="btn btn-sm btn-dark"><span class="fa fa-eye"></span></a>
                                <button type="button" class="btn btn-sm btn-danger" title="Delete">
                                    <i onclick="deleteItem({{ $row->id }})" class="fa fa-trash-alt"></i>
                                </button>
                                <form id="delete_form_{{ $row->id }}" method="POST" action="{{ route('users.destroy', $row->id) }}">
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