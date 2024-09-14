<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h1>Panel de Administrador</h1>
        <p>Bienvenido al panel de administración, {{ Auth::user()->name }}.</p>
        <!-- Aquí puedes añadir enlaces para gestionar usuarios, productos, estadísticas, etc. -->
    </div>
@endsection
