@extends('layouts.app')

{{-- Page content --}}
@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-users me-2"></i>
                Gestion des Leads
            </h1>
            <p class="text-muted mb-0">Gérez et suivez vos prospects efficacement</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-info fs-6">{{ $leads->total() }} leads total</span>
            <span class="badge bg-success fs-6">{{ $leads->where('sent_at', '!=', null)->count() }} emails envoyés</span>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Action Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title mb-1">
                        <i class="fas fa-paper-plane me-2 text-primary"></i>
                        Campagne Email
                    </h5>
                    <p class="card-text text-muted mb-0">
                        Lancez une campagne email vers tous les leads non contactés
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <form method="POST" action="{{ route('admin.leads.sendCampaign') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fas fa-rocket me-2"></i>
                            Lancer la campagne
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Leads Table Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="mb-0">
                        <i class="fas fa-table me-2"></i>
                        Liste des Leads
                    </h6>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-1"></i>
                            Filtres
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tous les leads</a></li>
                            <li><a class="dropdown-item" href="#">Emails envoyés</a></li>
                            <li><a class="dropdown-item" href="#">Emails non envoyés</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="border-0">
                                <i class="fas fa-hashtag me-1"></i>
                                ID
                            </th>
                            <th class="border-0">
                                <i class="fas fa-envelope me-1"></i>
                                Email
                            </th>
                            <th class="border-0">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Date d'inscription
                            </th>
                            <th class="border-0">
                                <i class="fas fa-paper-plane me-1"></i>
                                Status Email
                            </th>
                            <th class="border-0 text-center">
                                <i class="fas fa-cogs me-1"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leads as $lead)
                            <tr>
                                <td class="align-middle">
                                    <span class="badge bg-light text-dark">#{{ $lead->id }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <span class="fw-medium">{{ $lead->email }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="text-muted">{{ \Illuminate\Support\Carbon::parse($lead->created_at)->format('d/m/Y') }}</span>
                                    <small class="text-muted">{{ \Illuminate\Support\Carbon::parse($lead->created_at)->format('H:i') }}</small>
                                </td>
                                <td class="align-middle">
                                    @if($lead->sent_at)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>
                                            Envoyé
                                        </span>
                                        <br>
                                        <small class="text-muted">{{ \Illuminate\Support\Carbon::parse($lead->sent_at)->format('d/m/Y H:i') }}</small>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-clock me-1"></i>
                                            En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Envoyer email">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <h5>Aucun lead trouvé</h5>
                                        <p>Commencez par ajouter des leads à votre système</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($leads->hasPages())
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Affichage de {{ $leads->firstItem() }} à {{ $leads->lastItem() }} sur {{ $leads->total() }} résultats
                    </div>
                    <div>
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
    
    .text-gray-800 {
        color: #2d3748 !important;
    }
    
    .dropdown-menu {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .alert {
        border: none;
        border-radius: 0.5rem;
    }
</style>
@endsection