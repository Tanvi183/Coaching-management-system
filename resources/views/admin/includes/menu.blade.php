<!--Main Menu Start-->
<nav class="navbar navbar-expand-lg menu-bg">
    <!--    <a class="navbar-brand" href="#">LOGO</a>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="mobile-menu-icon fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Student
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class=""><a class="dropdown-item" href="{{ route('students.create') }}">Registration</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('students.class.wise') }}">Class Wise Student List</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('students.batch.wise') }}">Batch Wise Student List</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('students.index') }}">All Running Student List</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('all.past.student') }}">All Past Students</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('all.student') }}">All Students</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Attendance
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class=""><a class="dropdown-item" href="{{ route('add-attendance') }}">Add Attendance</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('view-attendance') }}">View Attendance</a></li>
                    <li class=""><a class="dropdown-item" href="#">Edit Attendance</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    School
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class=""><a class="dropdown-item" href="{{ route('schools.create') }}">Add School</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('schools.index') }}">School List</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Class
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class=""><a class="dropdown-item" href="{{ route('classes.create') }}">Add Class</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('classes.index') }}">Class List</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Batch
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li class=""><a class="dropdown-item" href="{{ route('batches.create') }}">Add Batch</a></li>
                    <li class=""><a class="dropdown-item" href="{{ route('batches.index') }}">Batch List</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('studenttypes.create') }}">Student Type</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Setting
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Slider</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('sliders.create') }}" class="dropdown-item">Add Slide</a></li>
                            <li><a href="{{ route('sliders.index') }}" class="dropdown-item">Manage Slide</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item" href="{{ route('all.slider.photo') }}">Gallery</a>
                    </li>

                    @if($users->role=='Admin')
                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">General</a>
                        <ul class="dropdown-menu">
                            @if(isset($header))
                                <li class="dropdown-submenu"><a href="{{ route('header_footers.edit',$header->id) }}" class="dropdown-item">Manage Header Footer</a></li>
                            @else
                                <li class="dropdown-submenu"><a href="{{ route('header_footers.create') }}" class="dropdown-item">Add Header Footer</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">Date</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('add-year') }}" class="dropdown-item">Add Year</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu">
                        <a class="dropdown-item dropdown-toggle" href="#">User</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->role=='Admin')
                                <li><a href="{{ route('users.create') }}" class="dropdown-item">Add User</a></li>
                                <li><a href="{{ route('users.index') }}" class="dropdown-item">User List</a></li>
                            @endif
                            <li><a href="{{ route('user.profile.view',['id'=>Auth::user()->id]) }}" class="dropdown-item">User Profile</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <a class="font-weight-bold my-2 my-sm-0 mr-2 logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
<!--Main Menu End-->
