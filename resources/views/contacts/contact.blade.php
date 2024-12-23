<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/contact.css') }}" rel="stylesheet">
    <title>Mis Contactos</title>
    <style>
        .not-found {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .not-found svg {
            width: 64px;
            height: 64px;
            margin-bottom: 20px;
        }
        .not-found h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .not-found p {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }
        .not-found button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 5px;
        }
        .modal-content input {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .modal-content button {
            width: 25%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @if(isset($contact) && !empty($contact))
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
    @else
    <div class="not-found">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="12"></line>
            <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <h1>Contacto no encontrado</h1>
        <p>No existe un usuario con ese ID. Por favor, verifique el número e intente nuevamente.</p>
        <button onclick="openModal()">Ingresar nuevo ID</button>
    </div>

    <div id="idModal" class="modal">
        <div class="modal-content">
            <input type="text" id="newId" placeholder="Ingrese nuevo ID">
            <button onclick="submitNewId()">Buscar</button>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('idModal').style.display = 'block';
        }

        function submitNewId() {
            var newId = document.getElementById('newId').value;
            if (newId) {
                window.location.href = '/contact/' + newId;
            }
        }
    </script>
    @endif
</body>
</html>