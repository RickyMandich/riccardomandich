@extends('layouts.app')

@section('title', 'Riccardo Mandich - Resume')

@section('content')
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <div class="resume-container py-5">
        <!-- Header Section -->
        <header class="glass-card mb-4">
            <div class="row align-items-center text-center text-md-start">
                <div class="col-md-3">
                    <div class="profile-img-container shadow-sm mx-auto mx-md-0 mb-4 mb-md-0">
                        <img src="{{ asset('images/foto-per-cv.jpg') }}" alt="Riccardo Mandich" class="profile-img">
                    </div>
                </div>
                <div class="col-md-7">
                    <h1 class="display-4 mb-2"><span class="text-gradient">Riccardo Mandich</span></h1>
                    <p class="lead text-muted mb-4">Full Stack Developer | Backend Oriented</p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                        <a href="mailto:riccardo.mandich.25@stud.itsaltoadriatico.it" class="contact-link">
                            <i class="bi bi-envelope-fill"></i> <span
                                class="d-none d-sm-inline">riccardo.mandich.25@stud.itsaltoadriatico.it</span>
                        </a>
                        <a href="tel:+393703513963" class="contact-link">
                            <i class="bi bi-telephone-fill"></i> <span class="d-none d-sm-inline">+39 370 351 3963</span>
                        </a>
                        <span class="contact-link">
                            <i class="bi bi-geo-alt-fill"></i> <span class="d-none d-sm-inline">Marghera, VE</span>
                        </span>
                    </div>
                </div>
                <div class="col-md-12 mt-4 mt-md-0">
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                        <a href="{{ asset('documents/10_Fust_Mandich_RIccardo.pdf') }}" target="_blank"
                            class="btn btn-warning rounded-pill px-3 fw-bold flex-grow-1 flex-md-grow-0">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Scarica CV
                        </a>
                        <a href="https://github.com/RickyMandich" target="_blank"
                            class="btn btn-outline-warning rounded-pill px-3 flex-grow-1 flex-md-grow-0">
                            <i class="bi bi-github"></i> Personal
                        </a>
                        <a href="https://github.com/MandichRiccardoITS" target="_blank"
                            class="btn btn-outline-info rounded-pill px-3 flex-grow-1 flex-md-grow-0">
                            <i class="bi bi-github"></i> ITS
                        </a>
                        <button type="button" class="btn btn-outline-light rounded-pill px-3 flex-grow-1 flex-md-grow-0"
                            data-bs-toggle="modal" data-bs-target="#qrModal">
                            <i class="bi bi-qr-code"></i> Condividi
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Modal QR Code -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-card border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title section-title mb-0" id="qrModalLabel">Condividi Portfolio</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <div class="p-3 bg-white d-inline-block rounded-3 mb-3">
                            <img id="qrImage" src="" alt="QR Code" style="width: 200px; height: 200px;">
                        </div>
                        <p class="text-muted small">Inquadra il QR Code per visualizzare questo curriculum sul tuo
                            smartphone.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar / Brief Profile -->
            <div class="col-lg-4 mb-3">
                <section class="glass-card h-100">
                    <h3 class="section-title"><i class="bi bi-person-fill"></i> Profilo Personale</h3>
                    <p class="text-muted">
                        Studente del 1° anno del corso FullStack Developer in ITS, motivato e orientato alla crescita nel
                        settore Backend.
                        Appassionato di sviluppo enterprise e gestione delle infrastrutture IT.
                    </p>

                    <hr class="my-4 border-secondary">

                    <h3 class="section-title"><i class="bi bi-globe"></i> Lingue</h3>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Italiano</span>
                            <span class="badge bg-warning text-dark">Madrelingua</span>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Inglese</span>
                            <span class="badge bg-info text-dark">Livello B2 (Non Certificato)</span>
                        </div>
                    </div>

                    <hr class="my-4 border-secondary">

                    <h3 class="section-title"><i class="bi bi-controller"></i> Hobby & Interessi</h3>
                    <p class="small text-muted mb-0">
                        Lettura, Star Wars Unlimited, Dungeons & Dragons, tiro con l'arco.
                    </p>
                </section>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Formazione -->
                <section class="glass-card">
                    <h3 class="section-title"><i class="bi bi-book-fill"></i> Formazione</h3>
                    <div class="timeline-item">
                        <h5 class="mb-0">ITS Academy Alto Adriatico di Pordenone</h5>
                        <p class="text-warning small mb-2">FullStack Developer | 2025 – 2027</p>
                        <div class="small text-muted">
                            Sviluppo enterprise (C#, ASP.NET, Node.js), Database (SQL Server, PostgreSQL), Cloud (Azure),
                            DevOps (CI/CD, Git) e UI/UX.
                        </div>
                    </div>
                    <div class="timeline-item mb-0">
                        <h5 class="mb-0">Istituto Fermi di Venezia</h5>
                        <p class="text-warning small mb-2">Diploma di Perito Informatico | 2025</p>
                        <div class="small text-muted text-uppercase">
                            Competenze sviluppate: pensiero computazionale.
                        </div>
                    </div>
                </section>

                <!-- Esperienze -->
                <section class="glass-card">
                    <h3 class="section-title"><i class="bi bi-briefcase-fill"></i> Esperienze Professionali</h3>
                    <div class="timeline-item mb-0">
                        <h5 class="mb-0">SIPE Scorzè</h5>
                        <p class="text-warning small mb-2">PCTO formativo | 09/2025 – 10/2025</p>
                        <div class="small text-muted">
                            Formazione nella creazione di una web app a partire dalle basi con Springboot, ORM e Maven
                            (accenni a Angular).
                        </div>
                    </div>
                </section>

                <!-- Competenze Tecniche -->
                <section class="glass-card">
                    <h3 class="section-title"><i class="bi bi-cpu-fill"></i> Competenze Tecniche a fine corso</h3>
                    <div class="mb-3">
                        <h6 class="text-muted small text-uppercase fw-bold mb-2">Linguaggi & Frameworks</h6>
                        <div class="d-flex flex-wrap">
                            <span class="skill-tag">C#</span>
                            <span class="skill-tag">ASP.NET</span>
                            <span class="skill-tag">Node.js</span>
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">TypeScript</span>
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">Springboot</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6 class="text-muted small text-uppercase fw-bold mb-2">Database & Strumenti</h6>
                        <div class="d-flex flex-wrap">
                            <span class="skill-tag">SQL Server</span>
                            <span class="skill-tag">PostgreSQL</span>
                            <span class="skill-tag">Docker</span>
                            <span class="skill-tag">VS Code</span>
                            <span class="skill-tag">JetBrains</span>
                            <span class="skill-tag">Azure</span>
                        </div>
                    </div>
                </section>

                <!-- Progetti Hobby -->
                <section class="glass-card">
                    <h3 class="section-title"><i class="bi bi-code-slash"></i> Progetti</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border border-secondary rounded-3 h-100">
                                <h6>UnlimitedDB.net</h6>
                                <p class="small text-muted">Database per il gioco `Star Wars Unlimited`.</p>
                                <a href="https://UnlimitedDB.net" target="_blank"
                                    class="small text-info text-decoration-none">Visita Sito <i
                                        class="bi bi-arrow-up-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border border-secondary rounded-3 h-100">
                                <h6>Phandalverse</h6>
                                <p class="small text-muted">Sito per la gestione di appunti del mondo di gioco della mia
                                    campagna di D&D.</p>
                                <a href="https://phandalverse.altervista.org" target="_blank"
                                    class="small text-info text-decoration-none">Visita Sito <i
                                        class="bi bi-arrow-up-right"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const qrImage = document.getElementById('qrImage');
                const currentUrl = encodeURIComponent(window.location.href);

                if (qrImage) {
                    qrImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${currentUrl}`;
                }
            });
        </script>
    @endsection
@endsection