@extends('admin.admin_layouts')
@section('admin_content')
    <!--Content Start-->
    <section class="container-fluid">
        <div class="row content">
            <div class="col-md-8 offset-md-2 pl-0 pr-0">

                <div class="form-group">
                    <div class="col-sm-12">
                        <h4 class="text-center font-weight-bold font-italic mt-3">School list</h4>
                    </div>
                </div>

            <div class="table-responsive p-1">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>School Name</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($schools as $row)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $row->school_name }}</td>
                            <td>{{ $row->status == 1 ? 'Published' : 'Unpublished' }}</td>
                            <td>
                                @if($row->status == 1)
                                    <a href="{{ Route('schools.unpublish',$row->id) }}" title="Deactivate" class="btn btn-sm btn-success"><span class="fa fa-arrow-alt-circle-up"></span></a>
                                @else
                                    <a href="{{ Route('schools.publish',$row->id) }}" title="Activate" class="btn btn-sm btn-warning"><span class="fa fa-arrow-alt-circle-down"></span></a>
                                @endif
                                <a href="{{ Route('schools.edit', $row->id) }}" class="btn btn-sm btn-info" title="Edit"><span class="fa fa-edit"></span></a>
                                <button type="button" class="btn btn-sm btn-danger" title="Delete">
                                    <i onclick="deleteItem({{ $row->id }})" class="fa fa-trash-alt"></i>
                                </button>
                                <form id="delete_form_{{ $row->id }}" method="POST" action="{{ route('schools.destroy', $row->id) }}">
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