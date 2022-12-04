
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('js/app.js') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title></title>
</head>

<body>
<nav class="navbar navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="#" style="padding-left:210px;">Admin</a>

    <div class="d-flex flex-row">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        {{--<a class="nav-link" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>--}}
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
<!-- The sidebar -->
<div class="sidebar bg-dark sticky-top">
    <div style="margin-top:55px;"></div>


        <div class="dropdown">
            <button class="dropdown-btn">Menu Item
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container" aria-labelledby="navbarDropdown">
               <a href="{{route('menu.create')}}">Create Menu</a>
               <a href="{{route('menu.index')}}">Menu List</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">Food Item
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container" aria-labelledby="navbarDropdown">
                <a href="{{route('food-item.create')}}">Create Food Item</a>
                <a href="{{route('food-item.index')}}">Food Item List</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">Additive
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container" aria-labelledby="navbarDropdown">
                <a href="{{route('additive.create')}}">Create Additive</a>
                <a href="{{route('additive.list')}}">Additive List</a>
            </div>
        </div>

    {{--  <button class="dropdown-btn">Sales
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="{{route('admin.order')}}">Order</a>
        <a href="{{route('booking.details')}}">Booking</a>

    </div>  --}}

    {{--  <button class="dropdown-btn">Marketing
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <div class="dropdown">
            <button class="dropdown-btn">Discount Offer
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container bg-dark" aria-labelledby="navbarDropdown">

                <a href="{{route('pickup.create')}}">Create Discount Offer</a>
                <a href="{{route('pickup')}}">Discount Offer List</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">Gallery
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container bg-dark" aria-labelledby="navbarDropdown">
                <a href="{{route('photo.create')}}">Create Gallery    </a>
                <a href="{{route('photo')}}"> Gallery List</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">Advertise
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container bg-dark" aria-labelledby="navbarDropdown">
                <a href="{{route('advertise.create')}}">Create Advertise</a>
                <a href="{{route('advertise')}}"> Advertise List</a>
            </div>
        </div>
    </div>  --}}
</div><!-- Page content -->

<body>

<!-- Page content -->
<div class="content">
    @yield('content')
</div>
</body>
<script src="{{asset('js/myjs.js')}}"></script>
</body>
</html>
