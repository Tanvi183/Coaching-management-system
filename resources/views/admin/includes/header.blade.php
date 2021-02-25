<!--Header Start-->
<section>
   @if(isset($header))
    <div class="col-sm-12 text-center header pb-1">
        <h2 class="font-weight-bold p-1 m-0">{{ $header->institute_name }}</h2>
        <h5 class="menu-bg p-2 pl-3 pr-3 mb-1">{{ $header->title }}</h5>
        <p class="font-weight-bold mb-0">{{ $header->address }}</p>
        <p class="font-weight-bold mb-0">CONTACT : {{ $header->mobile }} Or {{ $header->email }}</p>
    </div>
    @else
      <div class="col-sm-12 text-center header pb-1">
        <h2 class="font-weight-bold p-1 m-0">This is Admin Deshbord</h2>
        <h5 class="menu-bg p-2 pl-3 pr-3 mb-1">Admin Panel</h5>
        <p class="font-weight-bold mb-0">OsmanPur, Zorarjong, Chittagog</p>
        <p class="font-weight-bold mb-0">CONTACT : 880-1720873939 Or mneshat7@gmail.com</p>
    </div>
    @endif
</section>
<!--Header End-->

<!--User Avatar Start-->
<img class="avatar" src="@if(isset($users->avatar)){{ asset('/public/admin/profile/'.$users->avatar) }}
                        @else{{ asset('/public/images/avatar.png') }} @endif" alt="Avatar">
<!--User Avatar Start-->
