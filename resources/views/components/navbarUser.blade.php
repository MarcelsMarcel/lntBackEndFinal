<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('user.home')}}">BNCC Book Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('user.topup') }}">Top Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('cart.view') }}">Keranjang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('cart.invoices') }}">Invoices</a>
        </li>

    </div>
    <span class="me-3">Balance: Rp{{ Auth::user()->money }}</span>
    @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endif
  </div>
</nav>
