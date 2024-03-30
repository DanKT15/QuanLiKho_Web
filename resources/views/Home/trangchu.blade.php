@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

<h1>trang chu page</h1>


@if (Auth::check())
   <h2>Chào bạn {{Auth::user()->TENNV}}</h2>
   <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-responsive-nav-link :href="route('logout')"
              onclick="event.preventDefault();
                          this.closest('form').submit();">
          {{ __('Log Out') }}
      </x-responsive-nav-link>
  </form>
@else
   <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
   <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
@endif