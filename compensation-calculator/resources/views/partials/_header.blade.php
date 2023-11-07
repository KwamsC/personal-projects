<header class="top-0 mx-5 flex max-w-screen-xl items-center justify-between w-full">
    <a class="logo" href="/">
        <h2 class="text-3xl font-bold">Compensation calculator</h2>
    </a>
    <nav>
        <ul class="flex gap-4">
            @auth
                <li>
                    <span>Welcome {{ auth()->user()->name }}</span>
                </li>
                <li>
                    <a href="/compensations">Compensations</a>
                </li>
                <li>
                    <a href="/compensations/manage">Manage Compensations</a>
                </li>
                <li>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href=/register>Registration</a>
                </li>
                <li>
                    <a href="/login">Login</a>
                </li>
            @endauth
        </ul>
    </nav>
</header>
