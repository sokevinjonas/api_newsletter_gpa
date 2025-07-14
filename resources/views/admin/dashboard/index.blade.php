@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-chart-line me-2"></i>
                Dashboard des Leads
            </h1>
            <p class="text-muted">Vue d’ensemble des inscriptions et performances</p>
        </div>
    </div>

    <!-- Statistiques globales -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-primary">
                <div class="card-body">
                    <h6 class="card-title text-uppercase">Total Leads</h6>
                    <h3>{{ $totalLeads }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-success">
                <div class="card-body">
                    <h6 class="card-title text-uppercase">Emails envoyés</h6>
                    <h3>{{ $emailsSent }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-warning">
                <div class="card-body">
                    <h6 class="card-title text-uppercase">Taux d’envoi</h6>
                    <h3>{{ number_format($emailsSent / max($totalLeads, 1) * 100, 1) }}%</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-white bg-dark">
                <div class="card-body">
                    <h6 class="card-title text-uppercase">Nouveaux aujourd’hui</h6>
                    <h3>{{ $newToday }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique (si lib Chart.js ou autre) -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Inscription des leads (7 derniers jours)</h6>
        </div>
        <div class="card-body">
            <canvas id="leadsChart" height="100"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('leadsChart').getContext('2d');
    const leadsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Leads par jour',
                data: {!! json_encode($data) !!},
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: '#007bff',
                tension: 0.4
            }]
        }
    });
</script>
@endpush
@endsection
