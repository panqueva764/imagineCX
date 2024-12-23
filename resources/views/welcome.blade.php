<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Usuarios</title>
    <style>
        :root {
            --primary: #000000;
            --secondary: #ffffff;
            --accent: #ffd700;
            --success: #4CAF50;
            --info: #2196F3;
            --danger: #f44336;
            --text: #333333;
            --text-light: #777777;
            --background: #f4f4f4;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Roboto', 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background-color: var(--background);
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        header {
            background-color: var(--primary);
            color: var(--secondary);
            padding: 1rem 0;
            margin: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }
        nav ul {
            list-style-type: none;
            display: flex;
        }
        nav ul li {
            margin-left: 1.5rem;
        }
        nav ul li a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        nav ul li a:hover {
            background-color: var(--accent);
            color: var(--primary);
        }
        
        /* Estilos para el menú desplegado en móviles */
        nav ul {
            display: flex;
            gap: 1rem;
        }
        nav ul li {
            display: block;
            margin: 10px 0;
        }
        nav ul.show {
            display: block;
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: var(--primary);
            padding: 20px;
            border-radius: 8px;
            width: 200px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        /* Estilos para el menú hamburguesa */
        .menu-toggle {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }
        .menu-toggle div {
            width: 30px;
            height: 5px;
            background-color: var(--secondary);
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        /* Media queries para dispositivos móviles */
        @media (max-width: 768px) {
            nav ul {
                display: none;
                flex-direction: column;
            }
            nav ul.show {
                display: block;
            }
            .menu-toggle {
                display: flex;
            }
            .menu-toggle.open div:nth-child(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }
            .menu-toggle.open div:nth-child(2) {
                opacity: 0;
            }
            .menu-toggle.open div:nth-child(3) {
                transform: rotate(-45deg) translate(5px, -5px);
            }
        }

        main {
            padding: 2rem 0;
        }
        h1, h2 {
            margin-bottom: 1.5rem;
            color: var(--primary);
        }
        section {
            background-color: var(--secondary);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border-left: 4px solid var(--accent);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }
        section.show {
            opacity: 1;
            transform: translateY(0);
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        form {
            display: grid;
            gap: 1rem;
        }
        input, select, button {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        input:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
        }
        button {
            color: var(--secondary);
            border: none;
            cursor: pointer;
            margin: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-crear, .btn-consultar {
            background-color: var(--success);
        }
        .btn-modificar {
            background-color: var(--info);
        }
        .btn-eliminar {
            background-color: var(--danger);
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 1rem;
        }
        th, td {
            text-align: left;
            padding: 1rem;
        }
        th {
            background-color: var(--primary);
            color: var(--secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        tr {
            background-color: var(--secondary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        tr:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .paginador {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }
        .paginador button {
            background-color: var(--primary);
            color: var(--secondary);
            border: 1px solid var(--primary);
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
        }
        .paginador button:hover {
            background-color: var(--accent);
            color: var(--primary);
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: var(--secondary);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            z-index: 1000;
            max-width: 90%;
            width: 400px;
            border-top: 4px solid var(--accent);
        }
        .popup-content {
            text-align: center;
        }
        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
            transition: color 0.3s ease;
        }
        .popup-close:hover {
            color: var(--danger);
        }
        /* Nuevos estilos para la página de inicio */
        #home {
            text-align: center;
            padding: 3rem 0;
        }
        #home h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        #home p {
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto 2rem;
        }
        .feature-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .feature-button {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 30px;
            background-color: var(--primary);
            color: var(--secondary);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .feature-button:hover {
            background-color: var(--accent);
            color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
            }
            nav ul {
                margin-top: 1rem;
            }
            nav ul li {
                margin: 0 0.5rem;
            }
            form {
                grid-template-columns: 1fr;
            }
            th, td {
                padding: 0.75rem 0.5rem;
            }
            .btn-modificar, .btn-eliminar {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
            .feature-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <h1>Sistema de Gestión de Usuarios</h1>
                <!-- Menú hamburguesa -->
                <div class="menu-toggle">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <ul>
                    <li><a href="#home" class="feature-button">Inicio</a></li>
                    <li><a href="#consultar" class="feature-button">Consultar</a></li>
                    <li><a href="#crear" class="feature-button">Crear</a></li>
                    <li><a href="#consultar-id" class="feature-button">Buscar por ID</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">
        <section id="home">
            <h2>Bienvenido al Sistema de Gestión de Usuarios</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula.</p>
            <div class="feature-buttons">
                <a href="#" class="feature-button" data-target="consultar">Consultar Usuarios</a>
                <a href="#" class="feature-button" data-target="crear">Crear Usuario</a>
                <a href="#" class="feature-button" data-target="consultar-id">Buscar por ID</a>
            </div>
        </section>
        <br>
        <section id="consultar" style="display: none;">
            <h2>Consultar Usuarios</h2>
            <form>
                <input type="text" placeholder="Nombre">
                <input type="text" placeholder="Ciudad">
                <button type="submit" class="btn-consultar">Buscar</button>
            </form>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Ciudad</th>
                            <th>País</th>
                            <th>Código Postal</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Juan</td>
                            <td>Pérez</td>
                            <td>Madrid</td>
                            <td>España</td>
                            <td>28001</td>
                            <td>Calle Mayor 1</td>
                            <td>
                                <button class="btn-modificar">Modificar</button>
                                <button class="btn-eliminar">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>María</td>
                            <td>González</td>
                            <td>Barcelona</td>
                            <td>España</td>
                            <td>08001</td>
                            <td>Rambla Catalunya 10</td>
                            <td>
                                <button class="btn-modificar">Modificar</button>
                                <button class="btn-eliminar">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="paginador">
                <button>&laquo; Anterior</button>
                <button>1</button>
                <button>2</button>
                <button>3</button>
                <button>Siguiente &raquo;</button>
            </div>
        </section>
        <section id="crear" style="display: none;">
            <h2>Crear Nuevo Usuario</h2>
            <form id="crear-usuario-form">
                <input type="text" placeholder="Nombre" required>
                <input type="text" placeholder="Apellido" required>
                <input type="text" placeholder="Ciudad" required>
                <input type="text" placeholder="País" required>
                <input type="text" placeholder="Código Postal" required>
                <input type="text" placeholder="Dirección" required>
                <button type="submit" class="btn-crear">Crear Usuario</button>
            </form>
            <div id="popup" class="popup">
                <div class="popup-content">
                    <h3>Usuario Creado</h3>
                    <p>El usuario ha sido creado con éxito. ID de usuario: <span id="usuario-creado-id"></span></p>
                    <button class="popup-close">Cerrar</button>
                </div>
            </div>
        </section>
        <section id="consultar-id" style="display: none;">
        <h2>Consultar Usuario por ID</h2>
    <form id="consultar-id-form">
        <input type="number" placeholder="Ingrese el ID de usuario" required>
        <button type="submit" class="btn-consultar">Consultar</button>
    </form>
    <div id="resultado-consulta-id" style="display: none;">
        <div class="table-container"> <!-- Contenedor para hacerlo responsive -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Ciudad</th>
                        <th>País</th>
                        <th>Código Postal</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="resultado-consulta-id-body">
                    <!-- Aquí se agregan los resultados de la consulta -->
                </tbody>
            </table>
        </div> <!-- Cierre del contenedor -->
    </div>
</section>
    </main>
    <script>
        // Función para mostrar/ocultar secciones dinámicamente debajo de la principal
        function toggleSection(sectionId) {
            // Ocultamos todas las secciones secundarias excepto "home"
            document.querySelectorAll('main > section:not(#home)').forEach(section => {
                section.style.display = 'none';
            });

            // Mostramos la sección seleccionada debajo de la sección #home
            const sectionToShow = document.getElementById(sectionId);
            if (sectionToShow) {
                sectionToShow.style.display = 'block';
                sectionToShow.classList.add('show');
            }
        }

        // Event listeners para los botones de navegación
        document.querySelectorAll('.feature-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                toggleSection(this.getAttribute('data-target'));
            });
        });

        // Mostrar la sección 'home' por defecto y ocultar las demás
        toggleSection('home');

        // Manejo del formulario para crear usuario
        document.getElementById('crear-usuario-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const userId = Math.floor(Math.random() * 1000) + 1;
            document.getElementById('usuario-creado-id').textContent = userId;
            document.getElementById('popup').style.display = 'block';
        });

        // Cerrar popup
        document.querySelector('.popup-close').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

        // Manejo del formulario para consultar usuario por ID
        document.getElementById('consultar-id-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const userId = this.querySelector('input').value;

            // Simulación de usuario encontrado
            const usuarioEncontrado = {
                id: userId,
                nombre: 'Usuario',
                apellido: 'Ejemplo',
                ciudad: 'Ciudad Ejemplo',
                pais: 'País Ejemplo',
                codigoPostal: '12345',
                direccion: 'Calle Ejemplo 123'
            };

            const resultadoBody = document.getElementById('resultado-consulta-id-body');
            resultadoBody.innerHTML = `
                <tr>
                    <td>${usuarioEncontrado.id}</td>
                    <td>${usuarioEncontrado.nombre}</td>
                    <td>${usuarioEncontrado.apellido}</td>
                    <td>${usuarioEncontrado.ciudad}</td>
                    <td>${usuarioEncontrado.pais}</td>
                    <td>${usuarioEncontrado.codigoPostal}</td>
                    <td>${usuarioEncontrado.direccion}</td>
                    <td>
                        <button class="btn-modificar">Modificar</button>
                        <button class="btn-eliminar">Eliminar</button>
                    </td>
                </tr>
            `;
            document.getElementById('resultado-consulta-id').style.display = 'block';
        });

        // Manejo del menú hamburguesa
        const menuToggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('nav ul');
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('show');
            menuToggle.classList.toggle('open');
        });
    </script>
</body>
</html>
