<aside class="w-64 bg-white shadow-md hidden sm:block">
    <div class="p-6 border-b border-gray-200">
        <img src="{{ asset('img/logo.png') }}" alt="Logo UTB" class="h-10 mx-auto mb-2">
        <h1 class="text-xl font-bold text-center text-green-700">Selamat datang Guru {{ Auth::user()->name }}</h1>
    </div>
    <nav class="p-4">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('guru.dashboard') }}"
                    class="{{ request()->routeIs('guru.dashboard') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }} block py-2 px-4 rounded hover:bg-green-100">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-700 block py-2 px-4 rounded hover:bg-green-100">
                    Tugas
                </a>
            </li>
            <li>
                <a href="{{ route('guru.pengumpulan.index') }}"
                    class="{{ request()->routeIs('guru.pengumpulan.*') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }} block py-2 px-4 rounded hover:bg-green-100">
                    📋 Pengumpulan Tugas
                </a>
            </li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="block py-2 px-4 rounded text-red-600 hover:bg-red-100">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
</aside>
