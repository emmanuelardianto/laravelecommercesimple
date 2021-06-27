<h1 class="mb-3">{{ $header }}</h1>
@include('components.alert')
<ul class="nav mb-3">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('front.user') }}">My Account</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.user.wishlist') }}">Wishlist</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.user.address') }}">Address</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.user.transaction') }}">Transactions</a>
    </li>
</ul>