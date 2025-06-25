@extends('layouts.app')

@section('title', 'Restaurantes')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-utensils me-2"></i>Restaurantes</h1>
            @auth
                <a href="{{ route('restaurants.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nuevo Restaurante
                </a>
            @endauth
        </div>
    </div>
</div>

@if($restaurants->count() > 0)
    <div class="row">
        @foreach($restaurants as $restaurant)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card restaurant-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="card-text text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $restaurant->address }}
                        </p>
                        @if($restaurant->phone)
                            <p class="card-text text-muted">
                                <i class="fas fa-phone me-1"></i>{{ $restaurant->phone }}
                            </p>
                        @endif
                        @if($restaurant->categories->count() > 0)
                            <div class="mb-3">
                                @foreach($restaurant->categories as $category)
                                    <span class="badge bg-secondary me-1">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Ver Detalles
                            </a>
                            @auth
                                @if(auth()->id() == $restaurant->user_id)
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('restaurants.destroy', $restaurant) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este restaurante?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    @if($restaurants->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="Navegación de restaurantes">
                    {{ $restaurants->links() }}
                </nav>
            </div>
        </div>
    @endif
@else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                No hay restaurantes disponibles en este momento.
                @auth
                    <br><a href="{{ route('restaurants.create') }}" class="btn btn-primary mt-2">Crear el primer restaurante</a>
                @endauth
            </div>
        </div>
    </div>
@endif
@endsection 
