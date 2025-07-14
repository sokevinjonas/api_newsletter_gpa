@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chart-bar me-2"></i>Analytics</h1>
            <p class="text-muted mb-0">Analyse détaillée de vos leads et performances marketing</p>
        </div>
    </div>

    <!-- Indicateurs clés -->
    <div class="row mb-4">
        <x-analytics.card title="Taux de croissance hebdo" value="{{ $growthRate }}%" icon="chart-line" color="info" />
        <x-analytics.card title="Taux de leads contactés" value="{{ $sentRate }}%" icon="paper-plane" color="success" />
        <x-analytics.card title="Leads non contactés" value="{{ $pendingLeads }}" icon="clock" color="warning" />
        <x-analytics.card title="Source principale" value="{{ $mainSource }}" icon="network-wired" color="dark" />
    </div>

    <!-- Graphique d'évolution -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0"><i class="fas fa-chart-area me-2"></i> Évolution des leads</h6>
        </div>
        <div class="card-body">
            <canvas id="leadAnalyticsChart" height="100"></canvas>
        </div>
    </div>

    <!-- Répartition des sources -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0"><i class="fas fa-share-alt me-2"></i> Provenance des leads</h6>
        </div>
        <div class="card-body">
            <canvas id="leadSourcesChart" height="120"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('leadAnalyticsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nouveaux Leads',
                data: {!! json_encode($leadCounts) !!},
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.1)',
                tension: 0.4
            }]
        }
    });

    const ctx2 = document.getElementById('leadSourcesChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($sources) !!},
            datasets: [{
                data: {!! json_encode($sourceCounts) !!},
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d']
            }]
        }
    });
</script>
@endpush
@endsection
