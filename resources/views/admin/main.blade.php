@extends('admin.layout.layout')

@section('content')
<style>
    .stat-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    }
    .stat-icon {
        font-size: 2rem;
        opacity: 0.8;
    }
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }
    .stat-label {
        color: #6c757d;
        font-size: 1rem;
    }
    .stats-section {
        padding: 2.5rem 0;
    }
</style>


<section class="bg-light stats-section">
    <div class="container">
        <div class="row g-4">
            <!-- Работодатели -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card text-center p-4">
                    <div class="mb-3 text-primary">
                        <i class="bi bi-building stat-icon"></i>
                    </div>
                    <div class="stat-number text-primary">142</div>
                    <div class="stat-label mt-2">Работодателей</div>
                </div>
            </div>

            <!-- Соискатели -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card text-center p-4">
                    <div class="mb-3 text-success">
                        <i class="bi bi-people stat-icon"></i>
                    </div>
                    <div class="stat-number text-success">1 856</div>
                    <div class="stat-label mt-2">Соискателей</div>
                </div>
            </div>

            <!-- Резюме -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card text-center p-4">
                    <div class="mb-3 text-info">
                        <i class="bi bi-file-earmark-text stat-icon"></i>
                    </div>
                    <div class="stat-number text-info">2 103</div>
                    <div class="stat-label mt-2">Резюме</div>
                </div>
            </div>

            <!-- Вакансии -->
            <div class="col-md-6 col-lg-3">
                <div class="card stat-card text-center p-4">
                    <div class="mb-3 text-danger">
                        <i class="bi bi-briefcase stat-icon"></i>
                    </div>
                    <div class="stat-number text-danger">387</div>
                    <div class="stat-label mt-2">Вакансий</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
