<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">F1. Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        @if(Auth::guard('customer')->check())
            <!-- If customer is logged in -->
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::guard('customer')->User()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="">Profile</a>
                </li>
                <li>
                    <form action="{{ route('customer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Log out</button>
                    </form>
                </li>
            </ul>
        @else
            <!-- If not logged in -->
            <a class="nav-link btn btn-outline-primary" href="{{ route('customer.login') }}">
                Login
            </a>
        @endif
    </li>

   <li class="nav-item">
    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Cart;

        if (Auth::guard('customer')->check()) {
            $customer_id = Auth::guard('customer')->id();
            $cart_count = Cart::where('customer_id', $customer_id)->where('status','0')->count();
        } else {
            $cart_count = 0;
        }
    @endphp

    <a href="{{ route('cart.view') }}">
        🛒 Cart ({{ $cart_count }})
    </a>
</li>

</ul>

            </div>
        </div>
    </nav>

   @yield('content')


    <!-- Bootstrap JS (Includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
