<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Learning Platform - SMA Negeri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50 navbar-slide">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" class="h-12 w-12">
                    <div>
                        <h1 class="text-xl font-bold text-green-700">E-Learning SMA</h1>
                        <p class="text-sm text-gray-600">SMA Negeri Terbaik</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->role === 'guru')
                                <a href="{{ url('/guru/dashboard') }}"
                                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>Dashboard Guru
                                </a>
                            @elseif (Auth::user()->role === 'admin')
                                <a href="{{ url('/admin/dashboard') }}"
                                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-cog mr-2"></i>Dashboard Admin
                                </a>
                            @elseif (Auth::user()->role === 'siswa')
                                <a href="{{ url('/siswa/dashboard') }}"
                                    class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                                    <i class="fas fa-graduation-cap mr-2"></i>Dashboard Siswa
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium">
                                <i class="fas fa-sign-in-alt mr-1"></i>Masuk
                            </a>
                            <a href="{{ route('register') }}"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                <i class="fas fa-user-plus mr-1"></i>Daftar
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-24 pb-16 text-white relative overflow-hidden">
        <!-- Floating Elements Background -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 floating">
                <i class="fas fa-book text-white text-4xl opacity-20"></i>
            </div>
            <div class="absolute top-40 right-20 floating" style="animation-delay: 0.5s;">
                <i class="fas fa-graduation-cap text-white text-5xl opacity-20"></i>
            </div>
            <div class="absolute bottom-20 left-20 floating" style="animation-delay: 1s;">
                <i class="fas fa-laptop text-white text-3xl opacity-20"></i>
            </div>
            <div class="absolute top-60 left-1/2 floating" style="animation-delay: 1.5s;">
                <i class="fas fa-pencil-alt text-white text-4xl opacity-20"></i>
            </div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-4xl mx-auto">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" class="h-24 w-24 mx-auto mb-6 bounce-in">
                <h1 class="text-5xl font-bold mb-6 fade-in-up">
                    Selamat Datang di <br>
                    <span class="text-yellow-300 wave-animation inline-block">E-Learning SMA Negeri</span>
                </h1>
                <div class="mb-8">
                    <p class="text-xl typing-effect mx-auto" style="width: fit-content;">
                        Platform pembelajaran digital untuk generasi masa depan
                    </p>
                </div>
                <div class="flex flex-col md:flex-row gap-4 justify-center fade-in-up" style="animation-delay: 2s;">
                    <a href="{{ route('register') }}"
                        class="bg-yellow-500 text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-400 transition duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <i class="fas fa-rocket mr-2 pulse-icon"></i>Mulai Belajar Sekarang
                    </a>
                    <a href="#features"
                        class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-gray-800 transition duration-300 transform hover:scale-105">
                        <i class="fas fa-info-circle mr-2"></i>Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="p-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="text-4xl font-bold text-green-600 mb-2 statistics-counter">
                        <i class="fas fa-users text-5xl mb-4 pulse-icon"></i>
                        <div class="counter" data-target="500">0</div>+
                    </div>
                    <p class="text-gray-600">Siswa Aktif</p>
                </div>
                <div class="p-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="text-4xl font-bold text-blue-600 mb-2 statistics-counter">
                        <i class="fas fa-chalkboard-teacher text-5xl mb-4 pulse-icon"></i>
                        <div class="counter" data-target="25">0</div>+
                    </div>
                    <p class="text-gray-600">Guru Berpengalaman</p>
                </div>
                <div class="p-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="text-4xl font-bold text-purple-600 mb-2 statistics-counter">
                        <i class="fas fa-book text-5xl mb-4 pulse-icon"></i>
                        <div class="counter" data-target="15">0</div>+
                    </div>
                    <p class="text-gray-600">Mata Pelajaran</p>
                </div>
                <div class="p-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="text-4xl font-bold text-orange-600 mb-2 statistics-counter">
                        <i class="fas fa-certificate text-5xl mb-4 pulse-icon"></i>
                        <div class="counter" data-target="98">0</div>%
                    </div>
                    <p class="text-gray-600">Tingkat Kelulusan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Platform e-learning yang dirancang khusus untuk mendukung proses pembelajaran modern di SMA
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover" data-aos="flip-left" data-aos-delay="100">
                    <div class="text-green-600 text-5xl mb-6 pulse-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Pembelajaran Interaktif</h3>
                    <p class="text-gray-600 mb-4">
                        Akses materi pembelajaran yang interaktif dengan video, quiz, dan diskusi online yang mendukung
                        proses belajar mengajar tingkat SMA.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Video pembelajaran berkualitas tinggi</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Materi dalam berbagai format</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Diskusi interaktif</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg card-hover" data-aos="flip-left" data-aos-delay="200">
                    <div class="text-blue-600 text-5xl mb-6 pulse-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Manajemen Tugas</h3>
                    <p class="text-gray-600 mb-4">
                        Sistem manajemen tugas yang efisien dengan deadline otomatis, pengumpulan online, dan feedback
                        langsung dari guru.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Pengumpulan tugas online</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Deadline reminder</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Feedback real-time</li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg card-hover" data-aos="flip-left" data-aos-delay="300">
                    <div class="text-purple-600 text-5xl mb-6 pulse-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Monitoring Progress</h3>
                    <p class="text-gray-600 mb-4">
                        Pantau perkembangan belajar dengan dashboard analitik yang menampilkan progress dan pencapaian
                        siswa secara real-time.
                    </p>
                    <ul class="text-sm text-gray-500 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Dashboard analitik</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Laporan kemajuan</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Notifikasi otomatis</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="slide-right" data-aos-duration="1000">
                    <img src="{{ asset('img/logo.png') }}" alt="SMA Campus"
                        class="h-96 w-full object-cover rounded-lg shadow-lg transform hover:scale-105 transition duration-500">
                </div>
                <div data-aos="slide-left" data-aos-duration="1000">
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Tentang SMA Negeri</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        SMA Negeri adalah salah satu sekolah menengah atas terbaik yang berkomitmen
                        untuk memberikan pendidikan berkualitas tinggi melalui inovasi teknologi pembelajaran modern.
                    </p>
                    <p class="text-gray-600 mb-8">
                        Platform E-Learning ini dikembangkan untuk mendukung transformasi digital dalam dunia
                        pendidikan tingkat SMA, memungkinkan siswa dan guru untuk tetap terhubung dan melanjutkan proses
                        pembelajaran
                        dengan lebih fleksibel dan efektif.
                    </p>
                    <div class="flex space-x-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">2010</div>
                            <div class="text-sm text-gray-500">Tahun Berdiri</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">3</div>
                            <div class="text-sm text-gray-500">Jurusan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">A</div>
                            <div class="text-sm text-gray-500">Akreditasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-green-600 to-blue-600 text-white parallax-bg">
        <div class="container mx-auto px-4 text-center" data-aos="zoom-in" data-aos-duration="1000">
            <h2 class="text-4xl font-bold mb-6">Siap Memulai Perjalanan Belajar Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ratusan siswa yang telah merasakan pengalaman belajar yang lebih baik dengan
                platform e-learning kami.
            </p>
            <a href="{{ route('register') }}"
                class="bg-yellow-500 text-gray-900 px-10 py-4 rounded-lg font-bold text-lg hover:bg-yellow-400 transition duration-300 transform hover:scale-105">
                <i class="fas fa-graduation-cap mr-2"></i>Daftar Sekarang Gratis
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" class="h-10 w-10">
                        <div>
                            <h3 class="text-xl font-bold">E-Learning SMA</h3>
                            <p class="text-gray-400">SMA Negeri Terbaik</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Platform pembelajaran digital yang menghubungkan siswa, guru, dan ilmu pengetahuan
                        dalam satu ekosistem pembelajaran SMA yang modern dan efektif.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Tentang
                                Sekolah</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Program
                                Jurusan</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition duration-300">Berita</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition duration-300">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Pendidikan No. 123, Kota</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 21 1234567</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@smanegeri.sch.id</li>
                        <li><i class="fas fa-globe mr-2"></i>www.smanegeri.sch.id</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }} E-Learning SMA Negeri. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>
