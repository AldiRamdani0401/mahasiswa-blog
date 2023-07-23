@extends('layouts.main')

@section('container')
<!-- Header-->
<header class="bg-dark py-5" style="background-image: url('https://source.unsplash.com/1300x400/?university');">
        <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center my-5">
                    <h1 class="display-6 fw-bolder text-white mb-2" style="text-shadow: 4px 4px 4px rgba(0, 0, 0, 0.5);">Welcome To MahasiswaBlog</h1>
                    <p class="lead mb-4 shadow" style="text-shadow: 5px 5px 5px rgba(0, 0, 0, 0.5); color:white; font-size:16px; font-weight:bold;">A place to search and create articles to make the world a better place.</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="/login">Get Started</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="/about">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Features section-->
<section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection" style="margin-left: 10px"></i></div>
                <h2 class="h4 fw-bolder">All Articles</h2>
                <p>Cari dan temukan kumpulan lengkap artikel-artikel yang menarik, mencakup berbagai topik mulai dari ilmu pengetahuan dan teknologi hingga seni dan budaya.</p>
                <a class="text-decoration-none" href="/posts">
                    All Articles
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people" style="margin-left: 10px"></i></div>
                <h2 class="h4 fw-bolder">About us</h2>
                <p>Siapa Pengembang nya?, Seperti apa mereka?</p>
                <p>Apakah mereka <b>ROBOT</b> ?</p>
                <a class="text-decoration-none" href="/about">
                   Cari Tahu
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-4">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-pencil-square" style="margin-left: 10px"></i></div>
                <h2 class="h4 fw-bolder">I have some knowledge</h2>
                <p>Jika kamu orang yang suka Menulis, Banyak membaca buku, Bercerita tentang suatu pengalaman dan keterampilan yang menarik. Kenapa tidak mencoba berbagi disini? </p>
                <a class="text-decoration-none" href="/login">
                    Start Writing
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection