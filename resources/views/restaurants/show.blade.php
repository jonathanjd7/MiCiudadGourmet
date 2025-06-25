@extends('layouts.app')

@section('title', $restaurant->name)

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}">Restaurantes</a></li>
                <li class="breadcrumb-item active">{{ $restaurant->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h1 class="card-title">{{ $restaurant->name }}</h1>
                    @auth
                        @if(auth()->id() == $restaurant->user_id)
                            <div class="btn-group" role="group">
                                <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </a>
                                <form method="POST" action="{{ route('restaurants.destroy', $restaurant) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este restaurante?')">
                                        <i class="fas fa-trash me-1"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-muted mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <strong>Dirección:</strong>
                        </p>
                        <p>{{ $restaurant->address }}</p>
                    </div>
                    @if($restaurant->phone)
                        <div class="col-md-6">
                            <p class="text-muted mb-2">
                                <i class="fas fa-phone me-2"></i>
                                <strong>Teléfono:</strong>
                            </p>
                            <p>{{ $restaurant->phone }}</p>
                        </div>
                    @endif
                </div>

                @if($restaurant->categories->count() > 0)
                    <div class="mb-4">
                        <p class="text-muted mb-2">
                            <i class="fas fa-tags me-2"></i>
                            <strong>Categorías:</strong>
                        </p>
                        @foreach($restaurant->categories as $category)
                            <span class="badge bg-primary me-2">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif

                @if($restaurant->description)
                    <div class="mb-4">
                        <p class="text-muted mb-2">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Descripción:</strong>
                        </p>
                        <p>{{ $restaurant->description }}</p>
                    </div>
                @endif

                <div class="text-muted">
                    <small>
                        <i class="fas fa-user me-1"></i>Propietario: {{ $restaurant->user->name }}
                        <br>
                        <i class="fas fa-calendar me-1"></i>Creado: {{ $restaurant->created_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Sección de reseñas -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-star me-2"></i>Reseñas
                </h5>
            </div>
            <div class="card-body">
                @if($restaurant->reviews->count() > 0)
                    @foreach($restaurant->reviews->take(5) as $review)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $review->user->name }}</h6>
                                    <div class="text-warning mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                            </div>
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                    
                    @if($restaurant->reviews->count() > 5)
                        <div class="text-center">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                Ver todas las reseñas ({{ $restaurant->reviews->count() }})
                            </a>
                        </div>
                    @endif
                @else
                    <p class="text-muted text-center mb-0">
                        <i class="fas fa-comment-slash me-2"></i>
                        No hay reseñas aún
                    </p>
                @endif
            </div>
        </div>

        <!-- Información adicional -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Información
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-star text-warning me-2"></i>
                        Calificación promedio: 
                        @if($restaurant->reviews->count() > 0)
                            {{ number_format($restaurant->reviews->avg('rating'), 1) }}/5
                        @else
                            Sin calificaciones
                        @endif
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-comments text-info me-2"></i>
                        {{ $restaurant->reviews->count() }} reseñas
                    </li>
                    <li>
                        <i class="fas fa-eye text-secondary me-2"></i>
                        Visto {{ $restaurant->views ?? 0 }} veces
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection 
