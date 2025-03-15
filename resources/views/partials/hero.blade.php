<!-- Blog Hero Section -->
<section class="py-3 py-lg-4 py-xl-4">
    <div class="container overflow-hidden">
        <div class="row gy-5 gy-lg-0 align-items-lg-center justify-content-lg-between">
            <div class="col-12 col-lg-6 order-1 order-lg-0">
                <h2 class="display-3 fw-bold mb-3" style="color: #028773;">
                    <span id="typed-text"></span> <!-- Efek mengetik -->
                </h2>
                <p class="fs-4 mb-5">
                    Selami dunia pengetahuan dengan artikel komprehensif kami tentang teknologi,
                    gaya hidup, dan banyak lagi. Bergabunglah dengan komunitas kami dan ikuti perkembangan tren dan ide terkini.
                </p>
                @guest
                    <div class="d-grid gap-2 d-sm-flex">
                        <a href="{{ route('register') }}" type="button"
                            class="btn btn-outline-primary bsb-btn-2xl rounded-pill custom-btn">Register Now</a>
                    </div>
                @endguest
            </div>

            <div class="col-12 col-lg-5 text-center">
                <div class="position-relative">
                    <div class="bsb-circle border border-4 border-warning position-absolute top-50 start-10 translate-middle z-1"></div>
                    <div class="bsb-circle bg-primary position-absolute top-50 start-50 translate-middle" style="--bsb-cs: 380px;"></div>
                    <div class="bsb-circle border border-4 border-warning position-absolute top-10 end-0 z-1" style="--bsb-cs: 100px;"></div>
                    <img class="img-fluid position-relative z-2" loading="lazy"
                        src="{{ asset('images/blog.png') }}" alt="Welcome to Our Blog: Insights on AI and Web 3.0">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var options = {
            strings: ["Temukan Ide Menarik", "Jelajahi Dunia Teknologi", "Ikuti Perkembangan Trend"], // Kata yang diketik
            typeSpeed: 75,   // Kecepatan mengetik (ms per karakter)
            backSpeed: 70,   // Kecepatan menghapus
            backDelay: 1500, // Jeda sebelum menghapus
            startDelay: 1000, // Jeda sebelum mulai mengetik
            loop: true       // Mengulang terus-menerus
        };

        new Typed("#typed-text", options);
    });
</script>

<!-- Tambahkan CSS -->
<style>
    .custom-btn {
        color: #028773 !important;
        border-color: #028773 !important;
    }

    .custom-btn:hover {
        background-color: #028773 !important;
        color: white !important;
    }
</style>
