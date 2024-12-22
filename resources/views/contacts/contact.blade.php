<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Contactos</title>
<style>
    /* General */
    .contact-details {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        max-width: 414px;
        margin: 0 auto;
        background-color: #f2f2f7;
        min-height: 70vh;
        padding: 130px;
        display: flex;
        flex-direction: column;
    }

    /* Header del contacto */
    .contact-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .contact-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 15px;
        background-size: cover;
        background-position: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .contact-name {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        text-align: center;
    }

    .contact-company {
        color: #8e8e93;
        margin-top: 5px;
        font-size: 14px;
        text-align: center;
    }

    /* Botones de acción */
    .contact-actions {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .action-button {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #007aff;
        text-decoration: none;
        font-size: 12px;
    }

    .action-icon {
        width: 32px;
        height: 32px;
        margin-bottom: 5px;
    }

    /* Secciones de información */
    .info-section {
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .info-item {
        display: flex;
        padding: 15px;
        border-bottom: 1px solid #c8c7cc;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        flex: 1;
        color: #8e8e93;
        font-size: 14px;
    }

    .info-value {
        flex: 2;
        text-align: right;
        font-size: 14px;
    }

    /* Mobile responsiveness */
    @media (max-width: 414px) {
        .contact-details {
            padding: 15px;
        }

        .contact-avatar {
            width: 80px;
            height: 80px;
        }

        .contact-name {
            font-size: 18px;
        }

        .contact-company {
            font-size: 12px;
        }

        .action-button {
            font-size: 10px;
        }

        .info-item {
            padding: 10px;
        }

        .info-label, .info-value {
            font-size: 12px;
        }
    }
</style>

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
