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

        <form action="{{ route('update.user.photo') }}" method="post" enctype="multipart/form-data">
        	@csrf
            <div class="table-responsive p-1">
                <table class="table table-striped table-bordered dt-responsive nowrap text-center" style="width: 100%;">
              
                    <tr><td><img src="@if(isset($users->avatar)){{ asset('/public/admin/profile/'.$users->avatar) }} @else{{ asset('/public/images/avatar.png') }} @endif" alt="user-porfile" id="profile_photo" style="max-width: 400px;"></td></tr>
                    <tr>
                    	<td>
                    		<div class="input-group">
                    			<div class="custom-file">
                    				<input type="file" class="custom-file-input" name="image" id="avatar" onchange="showImage(this, 'profile_photo')">
                    				<label class="custom-file-label" for="inputGroupFile02" id="filelabel">Choose file</label>
                    			</div>
                    		</div>
                    	</td>
                    </tr>
                    
                    <input type="hidden" name="user_id" value="{{ $users->id }}">
                    <tr><td><button type="submit" class="btn btn-block my-btn-submit">Update Profile</button></td></tr>
                </table>
            </div>
        </form> 

        </div>
    </div>
</section>
<!--Content End-->

@endsection