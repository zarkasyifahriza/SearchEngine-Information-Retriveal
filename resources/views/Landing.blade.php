<!-- filepath: d:\laragon\www\SearchEngine-UTS\resources\views\Landing.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Engine Peraturan Perundang-undangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">INFORMATION RETRIEVAL</a>
            <div class="d-flex align-items-center">
                <span class="text-white fw-bold">ZARKASYI FAHRIZA - 220411100001</span>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main>
        <!-- Hero Section -->
        <div class="hero text-center py-5">
            <h1>PERATURAN PERUNDANG-UNDANGAN</h1>
            <p>Silahkan cari peraturan perundang-undangan</p>
            <p>Masukkan Nomor Undang-Undang, Judul Undang-Undang Atau Tahun</p>
            <div class="search-box d-flex justify-content-center">
                <input type="text" id="cari" class="form-control w-50 me-2" placeholder="Cari peraturan lainnya...">
                <select class="form-select w-auto me-2" name="rank" id="rank">
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                </select>
                <button id="search" class="btn btn-primary">Cari</button>
            </div>
        </div>

        <!-- Results Section -->
        <div class="container my-5 results-section">
            <div class="row" id="content">
                <!-- Hasil pencarian akan ditampilkan di sini -->
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-dark py-4">
        <div class="container">
            <div class="row">
                <!-- Tentang Website -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Tentang Website</h5>
                    <p class="text-muted">
                        Website ini merupakan sebuah search engine yang dirancang untuk mempermudah pencarian informasi terkait peraturan perundang-undangan di Indonesia. 
                        Dengan fitur pencarian yang spesifik, pengguna dapat mencari berdasarkan <strong>judul peraturan</strong>, <strong>nomor</strong>, atau <strong>tahun</strong>.
                        Website ini bertujuan untuk memberikan akses cepat dan akurat terhadap dokumen hukum yang relevan.
                    </p>
                    <p class="text-muted">
                        Data yang ditampilkan mencakup informasi seperti <strong>judul</strong>, <strong>deskripsi</strong>, <strong>nomor</strong>, dan <strong>tahun</strong> peraturan, 
                        serta tautan langsung ke dokumen terkait. Website ini diharapkan dapat membantu masyarakat, akademisi, dan praktisi hukum dalam menemukan informasi hukum yang dibutuhkan.
                    </p>
                </div>

                <!-- Ikuti Kami -->
                <div class="col-md-4 text-center">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="me-3 text-dark"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="me-3 text-dark"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="me-3 text-dark"><i class="fab fa-google-plus fa-lg"></i></a>
                        <a href="#" class="me-3 text-dark"><i class="fab fa-pinterest fa-lg"></i></a>
                        <a href="#" class="me-3 text-dark"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>

                <!-- Kontak Kami -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Kontak Kami</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Jl. Raya Telang, Perumahan Telang Indah, Telang, Kec. Kamal, Kabupaten Bangkalan, Jawa Timur 69162</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i>081775114422</p>
                    <p><i class="fas fa-envelope me-2"></i>zarkasyifaris@gmail.com</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            $("#search").click(function() {
                var cari = $("#cari").val().trim();
                var rank = $("#rank").val(); // Ambil nilai dari dropdown

                if (cari === "") {
                    alert("Masukkan kata kunci pencarian.");
                    return;
                }

                // Kosongkan hasil sebelumnya
                $('#content').html('<p class="text-center text-muted">Memuat hasil...</p>');

                $.ajax({
                    url: '/search',
                    data: { q: cari, rank: rank }, // Kirim nilai rank ke backend
                    dataType: "json",
                    method: "GET"
                })
                .done(function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    if (data.length === 0) {
                        $('#content').html('<p class="text-center text-muted">Tidak ada hasil ditemukan.</p>');
                    } else {
                        $('#content').html(data.map(item => `<div class="col-12">${item}</div>`).join(''));
                    }
                })
                .fail(function() {
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>