<aside class="w-64 bg-white shadow-md hidden sm:block">
    <div class="p-6 border-b border-gray-200">
        <img src="{{ asset('img/logo.png') }}" alt="Logo UTB" class="h-10 mx-auto mb-2">
        <h1 class="text-xl font-bold text-center text-green-700">Selamat datang Siswa</h1>
        <p class="text-xl font-bold text-center text-green-700">{{ Auth::user()->name }}</p>
    </div>
    <nav class="p-4">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('siswa.dashboard') }}"
                    class="{{ request()->routeIs('siswa.dashboard') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }} block py-2 px-4 rounded hover:bg-green-100">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('siswa.materi') }}"
                    class="{{ request()->routeIs('siswa.materi') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }} block py-2 px-4 rounded hover:bg-green-100">
                    Materi
                </a>
            </li>
            <li>
                <a href="{{ route('siswa.tugas') }}"
                    class="{{ request()->routeIs('siswa.tugas') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }} block py-2 px-4 rounded hover:bg-green-100">
                    Tugas
                </a>
            </li>

            <li>
                <a href="#" class="text-gray-700 block py-2 px-4 rounded hover:bg-green-100">
                    Absensi
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
