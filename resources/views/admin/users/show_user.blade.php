@extends('admin.admin_layouts')
@section('admin_content')

<!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-md-8 offset-md-2 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">{{ $users->name }}'s Profile</h4>
                </div>
            </div>

            <div class="table-responsive p-1">
                <table class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
              
                    <tr><td colspan="2"><img src="@if(isset($users->avatar)){{ asset('/public/admin/profile/'.$users->avatar) }} @else{{ asset('/public/images/avatar.png') }} @endif" alt="user-porfile"></td></tr>
                    
                    <tr><th>Name</th><td>{{ $users->name }}</td> </tr>
                    <tr><th>Role</th><td>{{ $users->role }}</td> </tr>
                    <tr><th>Mobile</th><td>{{ $users->mobile }}</td> </tr>
                    <tr><th>Email</th><td>{{ $users->email }}</td> </tr>

                </table>
            </div>
        </div>
    </div>
</section>
<!--Content End-->

@endsection