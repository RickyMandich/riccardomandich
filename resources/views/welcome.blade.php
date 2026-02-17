@extends('layouts.app')

@section('title', 'Riccardo Mandich - Resume')

@section('content')
<div class="bg-blob blob-1"></div>
<div class="bg-blob blob-2"></div>

<div class="resume-container py-5">
    <!-- Header Section -->
    <header class="glass-card mb-4 text-center text-md-start">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 mb-2"><span class="text-gradient">Riccardo Mandich</span></h1>
                <p class="lead text-muted mb-4">Full Stack Developer | Backend Oriented</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                    <a href="mailto:riccardo.mandich.25@stud.itsaltoadriatico.it" class="contact-link">
                        <i class="bi bi-envelope-fill"></i> Email
                    </a>
                    <a href="tel:+393703513963" class="contact-link">
                        <i class="bi bi-telephone-fill"></i> +39 370 351 3963
                    </a>
                    <span class="contact-link">
                        <i class="bi bi-geo-alt-fill"></i> Marghera, Venezia
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-center mt-4 mt-md-0">
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ asset('documents/10_Fust_Mandich_RIccardo.pdf') }}" target="_blank" class="btn btn-warning rounded-pill px-4 fw-bold">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Scarica CV
                    </a>
                    <a href="https://github.com/RickyMandich" target="_blank" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-github"></i> Personal
                    </a>
                    <a href="https://github.com/MandichRiccardoITS" target="_blank" class="btn btn-outline-info rounded-pill px-4">
                        <i class="bi bi-github"></i> Institutional
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="row">
        <!-- Sidebar / Brief Profile -->
        <div class="col-lg-4">
            <section class="glass-card h-100">
                <h3 class="section-title"><i class="bi bi-person-fill"></i> Profilo Personale</h3>
                <p class="text-muted">
                    Studente del 1° anno del corso FullStack Developer in ITS, motivato e orientato alla crescita nel settore Backend.
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
                        <span class="badge bg-info text-dark">Livello B2</span>
                    </div>
                </div>

                <hr class="my-4 border-secondary">

                <h3 class="section-title"><i class="bi bi-controller"></i> Hobby & Interessi</h3>
                <p class="small text-muted mb-0">
                    Lettura, Star Wars TCG, Dungeons & Dragons.
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
                        Sviluppo enterprise (C#, ASP.NET, Node.js), Database (SQL Server, PostgreSQL), Cloud (Azure), DevOps (CI/CD, Git) e UI/UX.
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
                        Formazione nella creazione di una web app a partire dalle basi con Springboot, ORM e Maven (accenni a Angular).
                    </div>
                </div>
            </section>

            <!-- Competenze Tecniche -->
            <section class="glass-card">
                <h3 class="section-title"><i class="bi bi-cpu-fill"></i> Competenze Tecniche</h3>
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
                <h3 class="section-title"><i class="bi bi-code-slash"></i> Progetti & Side Hustles</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 border border-secondary rounded-3 h-100">
                            <h6>UnlimitedDB.net</h6>
                            <p class="small text-muted">Database per gioco di carte collezionabili di Star Wars creato da zero.</p>
                            <a href="https://UnlimitedDB.net" target="_blank" class="small text-info text-decoration-none">Visita Sito <i class="bi bi-arrow-up-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border border-secondary rounded-3 h-100">
                            <h6>Phandalverse</h6>
                            <p class="small text-muted">Sito per la gestione di appunti e mondo di gioco D&D.</p>
                            <a href="https://phandalverse.altervista.org" target="_blank" class="small text-info text-decoration-none">Visita Sito <i class="bi bi-arrow-up-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection