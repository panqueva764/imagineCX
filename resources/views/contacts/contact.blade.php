<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/contact.css') }}" rel="stylesheet">
    <title>Mis Contactos</title>
<div class="contact-details">
    <!-- Encabezado del contacto -->
    <div class="contact-header">
        <div class="contact-avatar" style="background-image: url('https://i.pravatar.cc/150?img=5');"></div>
        <h1 class="contact-name">{{ $contact['lookupName'] }}</h1>
        <p class="contact-company">{{ $contact['customFields']['c']['company'] ?? 'No disponible' }}</p>
    </div>

    <!-- Acciones rápidas -->
    <div class="contact-actions">
        <a href="#" class="action-button">
            <span>📱</span>
            <span>Teléfono</span>
        </a>
        <a href="#" class="action-button">
            <span>💬</span>
            <span>Mensaje</span>
        </a>
        <a href="#" class="action-button">
            <span>📹</span>
            <span>Video</span>
        </a>
        <a href="#" class="action-button">
            <span>✉️</span>
            <span>Mail</span>
        </a>
    </div>

    <!-- Información del contacto -->
    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Teléfono</span>
            <span class="info-value">+1 234 567 890</span>
        </div>
        <div class="info-item">
            <span class="info-label">Correo</span>
            <span class="info-value">{{ $contact['lookupName'] }}@example.com</span>
        </div>
        <div class="info-item">
            <span class="info-label">Ciudad</span>
            <span class="info-value">{{ $contact['address']['city'] }}</span>
        </div>
    </div>

    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Empresa</span>
            <span class="info-value">{{ $contact['customFields']['c']['company'] ?? 'No disponible' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Cargo</span>
            <span class="info-value">Gerente de Ventas</span>
        </div>
    </div>

    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Notas</span>
            <span class="info-value">Cliente VIP, atención prioritaria</span>
        </div>
    </div>
</div>
