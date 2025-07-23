<aside class="w-64 bg-white shadow-md hidden sm:block">
    <div class="p-6 border-b border-gray-200">
        <img src="{{ asset('img/logo.png') }}" alt="Logo UTB" class="h-10 mx-auto mb-2">
        <h1 class="text-xl font-bold text-center text-green-700">Admin Panel</h1>
    </div>
    <nav class="p-4">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="block py-2 px-4 rounded hover:bg-green-100 {{ request()->routeIs('admin.dashboard') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }}"
                    class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.pelajaran') }}"
                    class="block py-2 px-4 rounded hover:bg-green-100 {{ request()->routeIs('admin.pelajaran') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }}">Mata
                    Pelajaran</a>
            </li>
            <li>
                <a href="{{ route('admin.kelola_pelajaran') }}"
                    class="block py-2 px-4 hover:bg-green-100 {{ request()->routeIs('admin.kelola_pelajaran') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }}">
                    Kelola Pelajaran
                </a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">Kelola Guru</a>
            </li>
            <li>
                <a href="{{ route('admin.register') }}"
                    class="block py-2 px-4 rounded hover:bg-green-100 {{ request()->routeIs('admin.register') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }}">
                    Register
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kelola_user') }}"
                    class="block py-2 px-4 rounded hover:bg-green-100 {{ request()->routeIs('admin.kelola_user') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }}">
                    Kelola User
                </a>
            </li>
            <li>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">Kelola Siswa</a>
            </li>

            <li>
                <a href="{{ route('admin.kelas.index') }}"
                    class="{{ request()->routeIs('admin.kelas.index') ? 'bg-green-100 text-green-700 font-semibold' : 'text-gray-700' }} block py-2 px-4 rounded hover:bg-green-100">
                    Tambah Kelas
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
