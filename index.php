<!DOCTYPE html>
<html lang="es">
<head>
    <!-- 
      ========================================================================
      PORTAL INSTITUCIONAL - ALCALDÍA DEL MUNICIPIO CRESPO (ESTADO LARA)
      ========================================================================
      
      SISTEMA DE CITAS, ATRIBUCIONES Y RECURSOS (CITATIONS)
      ------------------------------------------------------------------------
      Este proyecto web utiliza activos oficiales e institucionales de acuerdo
      con los parámetros gráficos autorizados:

      1. ACTIVOS GRÁFICOS Y LOGOTIPOS:
         - Isotipo / Escudo de Crespo: "IDENTIDAD CRESPO - ALCALDE_Mesa de trabajo 1.jpg"
           * Fuente original: Dirección de Comunicación de la Alcaldía de Crespo.
           * Licencia: Uso institucional exclusivo y gubernamental.
           * Propósito: Cabecera oficial del cintillo del ayuntamiento.
         - Firma de Gestión del Alcalde: "JG ORIGINAL@4x.png"
           * Fuente original: Despacho del Alcalde Julio Garcés.
           * Propósito: Identificación de la administración actual ("Sacándole el brillo a la Perla").

      2. LIBRERÍAS DE HOJAS DE ESTILOS (CSS):
         - Tailwind CSS (v3): Provisto por cdn.tailwindcss.com bajo licencia MIT.
         - Google Fonts (Inter): SIL Open Font License 1.1 (fonts.googleapis.com).
         - Font Awesome (v6.4.0): Iconografía libre provista mediante CDNJS.

      3. SISTEMA DE MAPAS E INFORMACIÓN GEOGRÁFICA:
         - Leaflet.js (v1.9.4): Biblioteca de mapas interactivos de código abierto.
         - Cartografía base: OpenStreetMap (openstreetmap.org) bajo licencia ODbL.
         
      ========================================================================
    -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alcaldía del Municipio Crespo - Lara, Venezuela (Portal Oficial)</title>
    
    <!-- LIBRERÍAS EXTERNAS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- CONFIGURACIÓN DE LA PALETA DE COLORES DE LA IDENTIDAD DE CRESPO -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        gov: {
                            wine: '#CE2029',      // Rojo Vibrante Institucional
                            dark: '#081E43',      // Azul Marino Profundo Corporativo
                            light: '#F8FAFC',     // Fondo minimalista claro e impecable
                            slate: '#64748B',     // Gris neutro para textos secundarios
                            border: '#E2E8F0',    // Línea de borde delgada minimalista
                            accent: '#73A7DC',    // Azul Cielo de la identidad
                            green: '#008B45'      // Verde Esmeralda de la identidad
                        }
                    }
                }
            }
        }
    </script>

    <!-- ====================================================================
         MÓDULO DE HOJAS DE ESTILO (VIRTUAL CSS STYLES)
         ==================================================================== -->
    <style>
        /* Reglas globales de renderizado de la interfaz */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
        }

        /* Comportamiento de menús desplegables gubernamentales */
        .submenu-hover:hover .submenu-list {
            display: block;
        }
        
        .nested-submenu-hover:hover .nested-submenu-list {
            display: block;
        }

        /* Transición limpia de desvanecimiento para el carrusel de noticias */
        .carousel-item {
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Contenedor del mapa real interactivo de Duaca */
        #map {
            height: 180px;
            width: 100%;
            border: 1px solid #E2E8F0;
            z-index: 10;
        }

        /* Scrollbar delgada de estilo administrativo */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
</head>
<body class="text-gov-dark min-h-screen flex flex-col selection:bg-gov-wine selection:text-white">

    <!-- ====================================================================
         MÓDULO DE MAQUETACIÓN (HTML MARKUP)
         ==================================================================== -->

    <!-- CINTILLO SUPERIOR OFICIAL (Header institucional con activos de IDENTIDAD CRESPO) -->
    <header class="bg-white border-b border-gov-border">
        <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <!-- Bloque Izquierdo: Logotipo del Municipio y Datos de la República -->
            <div class="flex items-center gap-4 text-center md:text-left">
                <div class="flex items-center justify-center">
                    <img src="Logo.png" alt="Logotipo Municipio Crespo" class="w-16 h-16 object-contain" onerror="this.src='https://placehold.co/100x100/081e43/ffffff?text=Crespo'">
                </div>
                
                <div class="space-y-0.5">
                    <h1 class="text-[9px] uppercase tracking-[0.25em] text-gov-slate font-semibold leading-none flex items-center gap-1.5 justify-center md:justify-start">
                        República Bolivariana de Venezuela
                    </h1>
                    <h2 class="text-[11px] font-bold text-gov-accent tracking-wide">Gobierno del Estado Lara • Municipio Crespo</h2>
                    <h3 class="text-2xl font-black text-gov-dark tracking-tight leading-none">Alcaldía de Crespo</h3>
                    <p class="text-[10px] tracking-[0.12em] font-bold text-gov-slate uppercase flex items-center justify-center md:justify-start gap-1.5">
                        Duaca, La Perla del Norte
                    </p>
                </div>
            </div>

            <!-- Bloque Derecho: Logotipo de la Gestión del Alcalde Julio Garcés -->
            <div class="flex flex-col items-center md:items-end text-center md:text-right gap-1.5">
                <img src="JGLogo.png" alt="Julio Garcés - Alcalde" class="h-14 md:h-16 object-contain" onerror="this.src='https://placehold.co/200x60/f8fafc/081e43?text=Alcalde+Julio+Garcés'">
            </div>
        </div>
    </header>

    <!-- BARRA SUPERIOR DE NAVEGACIÓN (Estilo minimalista con franja verde decorativa) -->
    <nav class="bg-gov-wine text-white sticky top-0 z-40 shadow-md border-b-2 border-gov-green">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Menú Móvil Cabecera -->
            <div class="flex justify-between md:hidden py-3">
                <span class="font-bold text-xs tracking-wider uppercase">PORTAL MUNICIPAL</span>
                <button onclick="toggleMobileMenu()" class="text-white focus:outline-none hover:text-gray-200 transition">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>

            <!-- Menú Desktop Horizontal -->
            <ul id="desktop-menu" class="hidden md:flex justify-start items-center text-xs font-semibold py-0.5">
                
                <!-- Item: Municipio Crespo -->
                <li class="relative group py-2">
                    <button class="px-4 py-2 hover:bg-black/15 transition flex items-center gap-1.5 focus:outline-none">
                        <i class="fa-solid fa-landmark text-white/80"></i>
                        Municipio Crespo
                        <i class="fa-solid fa-chevron-down text-[9px] opacity-80"></i>
                    </button>
                    <ul class="absolute left-0 mt-2 w-52 bg-white text-gov-dark border border-gov-border shadow-lg rounded hidden group-hover:block z-50">
                        <li><a href="#" onclick="openModal('simbolos-patrios')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition border-b border-gov-border flex items-center gap-2"><i class="fa-solid fa-flag text-gov-slate text-[11px]"></i> Símbolos Patrios</a></li>
                        <li><a href="#" onclick="openModal('simbolos-naturales')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition border-b border-gov-border flex items-center gap-2"><i class="fa-solid fa-leaf text-gov-slate text-[11px]"></i> Símbolos Naturales</a></li>
                        <li><a href="#" onclick="openModal('lugares-turisticos')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition border-b border-gov-border flex items-center gap-2"><i class="fa-solid fa-map-pin text-gov-slate text-[11px]"></i> Lugares Turísticos</a></li>
                        <li><a href="#" onclick="openModal('territorio')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition flex items-center gap-2"><i class="fa-solid fa-compass text-gov-slate text-[11px]"></i> Territorio</a></li>
                    </ul>
                </li>

                <!-- Item: Alcalde -->
                <li class="relative group py-2">
                    <button class="px-4 py-2 hover:bg-black/15 transition flex items-center gap-1.5 focus:outline-none">
                        <i class="fa-solid fa-user text-white/80"></i>
                        Alcalde
                        <i class="fa-solid fa-chevron-down text-[9px] opacity-80"></i>
                    </button>
                    <ul class="absolute left-0 mt-2 w-52 bg-white text-gov-dark border border-gov-border shadow-lg rounded hidden group-hover:block z-50">
                        <li><a href="#" onclick="openModal('alcalde-bio')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition flex items-center gap-2"><i class="fa-solid fa-id-badge text-gov-slate text-[11px]"></i> Julio Garcés (Biografía)</a></li>
                    </ul>
                </li>

                <!-- Item: Nosotros -->
                <li class="relative group py-2">
                    <button class="px-4 py-2 hover:bg-black/15 transition flex items-center gap-1.5 focus:outline-none">
                        <i class="fa-solid fa-circle-info text-white/80"></i>
                        Nosotros
                        <i class="fa-solid fa-chevron-down text-[9px] opacity-80"></i>
                    </button>
                    <ul class="absolute left-0 mt-2 w-52 bg-white text-gov-dark border border-gov-border shadow-lg rounded hidden group-hover:block z-50">
                        <li><a href="#" onclick="openModal('mision')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition border-b border-gov-border flex items-center gap-2"><i class="fa-solid fa-bullseye text-gov-slate text-[11px]"></i> Misión</a></li>
                        <li><a href="#" onclick="openModal('vision')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition border-b border-gov-border flex items-center gap-2"><i class="fa-solid fa-eye text-gov-slate text-[11px]"></i> Visión</a></li>
                        <li><a href="#" onclick="openModal('gestion-info')" class="block px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition flex items-center gap-2"><i class="fa-solid fa-clipboard-list text-gov-slate text-[11px]"></i> Gestión</a></li>
                    </ul>
                </li>

                <!-- Item: Direcciones (Plan de las 7 Transformaciones y Subdirecciones) -->
                <li class="relative group py-2">
                    <button class="px-4 py-2 hover:bg-black/15 transition flex items-center gap-1.5 focus:outline-none">
                        <i class="fa-solid fa-sitemap text-white/80"></i>
                        Secretarías 7 Transformaciones
                        <i class="fa-solid fa-chevron-down text-[9px] opacity-80"></i>
                    </button>
                    
                    <ul class="absolute left-0 mt-2 w-72 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden group-hover:block z-50">
                        <!-- T1: Modernización Económica -->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">1</span> Transformación Económica</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T1</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Desarrollo Agroproductivo, Comercial y Económico', 'T1: Económica', 'Encargada de potenciar la siembra y el apoyo técnico y formativo a pequeños y medianos productores del municipio.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Dirección de Desarrollo Agroproductivo, Comercial y Económico</a></li>
                                <li><a href="#" onclick="openDireccion('Brigada de Desarrollo Protegido', 'T1: Económica', 'Regula e impulsa las actividades comerciales, de emprendimiento y el registro económico local en Duaca.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Brigada de Desarrollo Protegido<</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Turismo', 'T1: Económica', 'Coordina con las torrefactoras locales la optimización, calidad y exportación del café de Crespo.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Dirección de Turismo</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Emprendimiento', 'T1: Económica', 'Coordina con las torrefactoras locales la optimización, calidad y exportación del café de Crespo.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Dirección de Emprendimiento</a></li>
                                <li><a href="#" onclick="openDireccion('Órgano Municipal de Economía Productiva', 'T1: Económica', 'Coordina con las torrefactoras locales la optimización, calidad y exportación del café de Crespo.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Órgano Municipal de Economía Productiva</a></li>
                            </ul>
                        </li>

                        <!-- T2: Transformación de los Servicios Públicos e Infraestructura-->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">2</span> Transformación de los Servicios Públicos e Infraestructura</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T2</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Servicios Públicos, Patrimonio e Identidad', 'T2: Independencia', 'Fomenta el arraigo histórico, cuidado de escuelas locales y protección del casco colonial de Duaca.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Dirección de Servicios Públicos y Patrimonio</a></li>
                                <li><a href="#" onclick="openDireccion('Oficina de Innovación, Ciencia y Tecnología', 'T2: Independencia', 'Promueve el acceso a la tecnología, infocentros y proyectos de modernización gubernamental digital.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Oficina de Ciencia y Tecnología</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Cultura y Tradiciones Populares', 'T2: Independencia', 'Preserva el folclor municipal, las festividades de San Juan Bautista y actividades artísticas.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Dirección de Cultura "La Perla"</a></li>
                            </ul>
                        </li>

                        <!-- T3: Paz, Seguridad y Territorio -->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">3</span> Paz, Seguridad y Territorio</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T3</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Seguridad Ciudadana y Convivencia', 'T3: Paz y Seguridad', 'Coordina los planes preventivos, la convivencia comunal y el enlace con las fuerzas de seguridad.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Dirección de Seguridad Ciudadana</a></li>
                                <li><a href="#" onclick="openDireccion('Oficina de Gestión de Riesgos y Protección Civil', 'T3: Paz y Seguridad', 'Atención de emergencias y monitoreo constante de zonas vulnerables de la geografía crespense.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Gestión de Riesgos y PC</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Catastro Municipal', 'T3: Paz y Seguridad', 'Ente rector de la delimitación territorial, zonificación y registro catastral de los inmuebles.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Dirección de Catastro Municipal</a></li>
                            </ul>
                        </li>

                        <!-- T4: Protección Social -->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">4</span> Protección Social del Pueblo</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T4</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Salud y Bienestar Social', 'T4: Social', 'Gestión de la red de atención primaria, entrega de medicinas y jornadas de salud rural.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Dirección de Salud y Bienestar</a></li>
                                <li><a href="#" onclick="openDireccion('Instituto Municipal de la Mujer y la Familia', 'T4: Social', 'Promueve el empoderamiento, asesoría legal y el resguardo integral de la familia en Crespo.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Instituto Municipal de la Mujer</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Vivienda y Hábitat Crespo', 'T4: Social', 'Monitoreo de desarrollos habitacionales e impulsos de mejoras para viviendas vulnerables.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Dirección de Vivienda</a></li>
                            </ul>
                        </li>

                        <!-- T5: Democracia Directa -->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">5</span> Democracia Directa (Poder Popular)</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T5</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Comunas y Consejos Comunales', 'T5: Poder Popular', 'Articula los planes de desarrollo y el financiamiento de proyectos comunales y autogestionados.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Comunas y Consejos Comunales</a></li>
                                <li><a href="#" onclick="openDireccion('Oficina de Atención Ciudadana (OAC)', 'T5: Poder Popular', 'Enlace directo para trámites, quejas, reclamos y solicitudes directas enviadas por la ciudadanía.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Oficina de Atención Ciudadana</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Planificación y Presupuesto Participativo', 'T5: Poder Popular', 'Formulación del presupuesto soberano con debates comunitarios abiertos.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Planificación Participativa</a></li>
                            </ul>
                        </li>

                        <!-- T6: Ecología y Preservación -->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">6</span> Ecología y Preservación</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T6</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Ecosocialismo, Parques y Reciclaje', 'T6: Ecología', 'Coordina programas ambientales, cuidado del Parque Barro Negro y recolección de desechos selectiva.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Ecosocialismo y Reciclaje</a></li>
                                <li><a href="#" onclick="openDireccion('Oficina de Parques y Áreas Verdes', 'T6: Ecología', 'Saneamiento, desmalezamiento y paisajismo urbano en plazas, avenidas y zonas de recreo.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Parques y Áreas Verdes</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Aguas y Saneamiento Ambiental', 'T6: Ecología', 'Optimización técnica del sistema de acueductos municipales y limpieza de ríos y quebradas.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Aguas y Saneamiento</a></li>
                            </ul>
                        </li>

                        <!-- T7: Geopolítica y Enlaces -->
                        <li class="relative submenu-hover border-b border-gov-border">
                            <div class="flex items-center justify-between px-4 py-2.5 hover:bg-gov-light hover:text-gov-wine transition cursor-pointer">
                                <span class="text-[11px] font-medium flex items-center gap-2"><span class="bg-red-100 text-gov-wine rounded-full w-4 h-4 flex items-center justify-center text-[8px] font-bold">7</span> Geopolítica y Enlaces</span>
                                <i class="fa-solid fa-chevron-right text-[8px] text-gov-slate"></i>
                            </div>
                            <ul class="submenu-list absolute left-full top-0 ml-0.5 w-64 bg-white text-gov-dark border border-gov-border shadow-2xl rounded hidden">
                                <li class="bg-gov-light px-4 py-1.5 text-[9px] font-bold text-gov-slate border-b border-gov-border uppercase">Direcciones T7</li>
                                <li><a href="#" onclick="openDireccion('Dirección de Relaciones Interinstitucionales', 'T7: Geopolítica', 'Enlace estratégico con entes de la Gobernación de Lara y Ministerios nacionales para proyectos conjuntos.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Relaciones Interinstitucionales</a></li>
                                <li><a href="#" onclick="openDireccion('Oficina de Cooperación e Inversión', 'T7: Geopolítica', 'Promueve acuerdos de intercambio agrícola, cultural y técnico con municipios y entes afines.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] border-b border-gov-border transition">Cooperación e Inversión</a></li>
                                <li><a href="#" onclick="openDireccion('Dirección de Desarrollo Comunitario y Redes Geopolíticas', 'T7: Geopolítica', 'Estudio estratégico del territorio de Crespo y empoderamiento de las micro-redes sociales de autogestión.')" class="block px-4 py-2 hover:bg-gov-light hover:text-gov-wine text-[11px] transition">Desarrollo Comunitario</a></li>
                            </ul>
                        </li>

                        <!-- Organigrama -->
                        <li>
                            <a href="#" onclick="openModal('organigrama')" class="block px-4 py-3 hover:bg-gov-light hover:text-gov-wine text-gov-dark font-bold transition flex items-center gap-2">
                                <i class="fa-solid fa-sitemap text-gov-slate text-[11px]"></i> Organigrama Municipal
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Menú Móvil Desplegable -->
        <div id="mobile-menu" class="hidden md:hidden bg-gov-dark border-t border-slate-700 px-4 py-3">
            <ul class="space-y-3 text-xs">
                <li>
                    <p class="text-[10px] font-bold uppercase text-gov-slate tracking-wider mb-1">Municipio Crespo</p>
                    <div class="grid grid-cols-2 gap-1.5 pl-2">
                        <a href="#" onclick="openModal('simbolos-patrios')" class="bg-white/5 p-2 rounded hover:bg-white/10 block">Símbolos Patrios</a>
                        <a href="#" onclick="openModal('simbolos-naturales')" class="bg-white/5 p-2 rounded hover:bg-white/10 block">Símbolos Naturales</a>
                        <a href="#" onclick="openModal('lugares-turisticos')" class="bg-white/5 p-2 rounded hover:bg-white/10 block">Turismo</a>
                        <a href="#" onclick="openModal('territorio')" class="bg-white/5 p-2 rounded hover:bg-white/10 block">Territorio</a>
                    </div>
                </li>
                <li class="border-t border-slate-700 pt-2">
                    <p class="text-[10px] font-bold uppercase text-gov-slate tracking-wider mb-1">Alcalde</p>
                    <a href="#" onclick="openModal('alcalde-bio')" class="bg-white/5 p-2 rounded hover:bg-white/10 block ml-2">Julio Garcés</a>
                </li>
                <li class="border-t border-slate-700 pt-2">
                    <p class="text-[10px] font-bold uppercase text-gov-slate tracking-wider mb-1">Nosotros</p>
                    <div class="grid grid-cols-3 gap-1.5 pl-2">
                        <a href="#" onclick="openModal('mision')" class="bg-white/5 p-2 rounded hover:bg-white/10 text-center">Misión</a>
                        <a href="#" onclick="openModal('vision')" class="bg-white/5 p-2 rounded hover:bg-white/10 text-center">Visión</a>
                        <a href="#" onclick="openModal('gestion-info')" class="bg-white/5 p-2 rounded hover:bg-white/10 text-center">Gestión</a>
                    </div>
                </li>
                <li class="border-t border-slate-700 pt-2">
                    <p class="text-[10px] font-bold uppercase text-gov-slate tracking-wider mb-1">Plan 7T (Direcciones)</p>
                    <div class="space-y-1.5 pl-2">
                        <button onclick="toggleMobile7T()" class="w-full text-left text-[11px] bg-gov-wine/60 p-2 rounded flex justify-between items-center">
                            <span>Ver Direcciones de las 7T</span>
                            <i class="fa-solid fa-chevron-down text-[8px]"></i>
                        </button>
                        <div id="mobile-7t-list" class="hidden space-y-1 p-2 bg-gov-dark/50 rounded border border-slate-700">
                            <a href="#" onclick="openModal('organigrama')" class="block text-center bg-white/10 p-2 rounded text-white font-bold mb-2">Ver Organigrama Completo</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- CUERPO PRINCIPAL (Distribución limpia 70% / 30%) -->
    <main class="flex-grow max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-10 gap-6">
            
            <!-- SECCIÓN IZQUIERDA (70%): Carrusel Automático de Acciones -->
            <section class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <h4 class="text-sm font-extrabold uppercase text-gov-dark tracking-wider mb-3 flex items-center gap-2">
                        <span class="w-1.5 h-4 bg-gov-green inline-block"></span>
                        Gestión en Acción (Noticias Destacadas)
                    </h4>
                    
                    <div class="relative overflow-hidden rounded bg-gov-dark h-80 lg:h-[400px] shadow-sm border border-gov-border">
                        <!-- Slide 1 -->
                        <div id="slide-0" class="carousel-item absolute inset-0 opacity-100 flex flex-col justify-end p-6 md:p-8 text-white transition-all duration-1000" style="background-image: linear-gradient(rgba(8,30,67,0.15), rgba(8,30,67,0.9));">
                            <div class="absolute inset-0 bg-gradient-to-tr from-gov-wine to-gov-accent -z-10 opacity-80"></div>
                            <div class="space-y-2 max-w-2xl">
                                <span class="bg-gov-accent text-gov-dark text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Infraestructura y Asfalto</span>
                                <p class="text-xl md:text-2xl font-bold tracking-tight">Plan Integral de Asfalto e Iluminación en Duaca</p>
                                <p class="text-xs text-slate-200 line-clamp-2">Llevamos soluciones viales concretas a las principales avenidas y arterias viales de la capital de Crespo y sus caseríos rurales.</p>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div id="slide-1" class="carousel-item absolute inset-0 opacity-0 flex flex-col justify-end p-6 md:p-8 text-white transition-all duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-tr from-gov-green to-gov-dark -z-10 opacity-85"></div>
                            <div class="space-y-2 max-w-2xl">
                                <span class="bg-gov-green text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Atención Social</span>
                                <p class="text-xl md:text-2xl font-bold tracking-tight">Jornada de Salud Directa "Pura Gente Buena"</p>
                                <p class="text-xs text-slate-200 line-clamp-2">Atención médica gratuita, entrega directa de medicinas y valoraciones generales en el sector rural de las Parroquias Freitez y José M. Blanco.</p>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div id="slide-2" class="carousel-item absolute inset-0 opacity-0 flex flex-col justify-end p-6 md:p-8 text-white transition-all duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-tr from-gov-wine to-gov-dark -z-10 opacity-85"></div>
                            <div class="space-y-2 max-w-2xl">
                                <span class="bg-gov-wine text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Cultura Municipal</span>
                                <p class="text-xl md:text-2xl font-bold tracking-tight">Embellecimiento e Impulso Cultural en Plaza Bolívar</p>
                                <p class="text-xs text-slate-200 line-clamp-2">Rehabilitamos y activamos espacios recreacionales públicos para el sano esparcimiento, la cultura tradicional y el disfrute familiar.</p>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div id="slide-3" class="carousel-item absolute inset-0 opacity-0 flex flex-col justify-end p-6 md:p-8 text-white transition-all duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-tr from-gov-green to-gov-wine -z-10 opacity-85"></div>
                            <div class="space-y-2 max-w-2xl">
                                <span class="bg-gov-wine text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Sector Caficultor</span>
                                <p class="text-xl md:text-2xl font-bold tracking-tight">Entrega de Insumos y Apoyo a los Caficultores</p>
                                <p class="text-xs text-slate-200 line-clamp-2">Fortalecemos la identidad productiva del municipio de la mano de los productores de café, motor de desarrollo de Crespo.</p>
                            </div>
                        </div>

                        <!-- Indicadores lineales -->
                        <div class="absolute bottom-4 left-6 flex space-x-2 z-20">
                            <span id="dot-0" onclick="setSlide(0)" class="w-8 h-1 bg-white cursor-pointer opacity-100 transition-all duration-300"></span>
                            <span id="dot-1" onclick="setSlide(1)" class="w-8 h-1 bg-white/40 cursor-pointer opacity-100 transition-all duration-300"></span>
                            <span id="dot-2" onclick="setSlide(2)" class="w-8 h-1 bg-white/40 cursor-pointer opacity-100 transition-all duration-300"></span>
                            <span id="dot-3" onclick="setSlide(3)" class="w-8 h-1 bg-white/40 cursor-pointer opacity-100 transition-all duration-300"></span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECCIÓN DERECHA (30%): Trámites y Accesos Corporativos -->
            <section class="lg:col-span-3">
                <h4 class="text-sm font-extrabold uppercase text-gov-dark tracking-wider mb-3 flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-gov-wine inline-block"></span>
                    Trámites y Servicios
                </h4>
                
                <div class="flex flex-col gap-2.5">
                    <!-- Informe de Gestión -->
                    <button onclick="openModal('tramite-informe')" class="group relative w-full bg-white hover:bg-gov-light text-gov-dark p-3.5 rounded border border-gov-border shadow-sm hover:shadow transition duration-200 flex items-center gap-3.5 text-left font-sans">
                        <div class="border-r border-gov-border pr-3 text-gov-wine text-lg group-hover:scale-105 transition duration-200">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gov-dark group-hover:text-gov-wine transition">Informe de Gestión</span>
                            <span class="block text-[10px] text-gov-slate">Cuentas y rendición de cara al pueblo</span>
                        </div>
                        <i class="fa-solid fa-chevron-right absolute right-4 text-[10px] text-gov-slate opacity-0 group-hover:opacity-100 transition duration-200"></i>
                    </button>

                    <!-- Trámites -->
                    <button onclick="openModal('tramite-general')" class="group relative w-full bg-white hover:bg-gov-light text-gov-dark p-3.5 rounded border border-gov-border shadow-sm hover:shadow transition duration-200 flex items-center gap-3.5 text-left">
                        <div class="border-r border-gov-border pr-3 text-gov-wine text-lg group-hover:scale-105 transition duration-200">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gov-dark group-hover:text-gov-wine transition">Trámites Municipales</span>
                            <span class="block text-[10px] text-gov-slate">Permisos de construcción y zonificación</span>
                        </div>
                        <i class="fa-solid fa-chevron-right absolute right-4 text-[10px] text-gov-slate opacity-0 group-hover:opacity-100 transition duration-200"></i>
                    </button>

                    <!-- Recaudación -->
                    <button onclick="openModal('tramite-recaudacion')" class="group relative w-full bg-white hover:bg-gov-light text-gov-dark p-3.5 rounded border border-gov-border shadow-sm hover:shadow transition duration-200 flex items-center gap-3.5 text-left">
                        <div class="border-r border-gov-border pr-3 text-gov-wine text-lg group-hover:scale-105 transition duration-200">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gov-dark group-hover:text-gov-wine transition">Recaudación / Impuestos</span>
                            <span class="block text-[10px] text-gov-slate">Portal del Contribuyente - SEDEMATRI</span>
                        </div>
                        <i class="fa-solid fa-chevron-right absolute right-4 text-[10px] text-gov-slate opacity-0 group-hover:opacity-100 transition duration-200"></i>
                    </button>

                    <!-- Trimestres -->
                    <button onclick="openModal('tramite-trimestres')" class="group relative w-full bg-white hover:bg-gov-light text-gov-dark p-3.5 rounded border border-gov-border shadow-sm hover:shadow transition duration-200 flex items-center gap-3.5 text-left">
                        <div class="border-r border-gov-border pr-3 text-gov-wine text-lg group-hover:scale-105 transition duration-200">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gov-dark group-hover:text-gov-wine transition">Trimestres y Presupuesto</span>
                            <span class="block text-[10px] text-gov-slate">Distribución trimestral del Situado</span>
                        </div>
                        <i class="fa-solid fa-chevron-right absolute right-4 text-[10px] text-gov-slate opacity-0 group-hover:opacity-100 transition duration-200"></i>
                    </button>

                    <!-- Registro Civil -->
                    <button onclick="openModal('tramite-civil')" class="group relative w-full bg-white hover:bg-gov-light text-gov-dark p-3.5 rounded border border-gov-border shadow-sm hover:shadow transition duration-200 flex items-center gap-3.5 text-left">
                        <div class="border-r border-gov-border pr-3 text-gov-wine text-lg group-hover:scale-105 transition duration-200">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-gov-dark group-hover:text-gov-wine transition">Registro Civil</span>
                            <span class="block text-[10px] text-gov-slate">Actas de nacimiento, uniones y defunciones</span>
                        </div>
                        <i class="fa-solid fa-chevron-right absolute right-4 text-[10px] text-gov-slate opacity-0 group-hover:opacity-100 transition duration-200"></i>
                    </button>
                </div>
            </section>

        </div>
    </main>

    <!-- PIE DE PÁGINA (Fondo mate minimalista con mapa y feed simulado) -->
    <footer class="bg-gov-dark text-white border-t border-slate-850 pt-8 pb-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8 pb-6 border-b border-slate-850">
            
            <!-- Izquierda: Instagram Feed Simulador -->
            <div class="flex flex-col">
                <h5 class="text-xs font-bold uppercase tracking-wider text-gov-accent mb-3 flex items-center gap-2">
                    <i class="fa-brands fa-instagram text-white/80"></i>
                    @JulioGarcesCrespo
                </h5>
                <div class="bg-slate-900/40 p-3 rounded border border-slate-800 relative shadow-sm">
                    <div class="relative overflow-hidden h-36 bg-slate-950 flex items-center justify-center">
                        <!-- Post IG 1 -->
                        <div id="ig-0" class="absolute inset-0 flex flex-col justify-between p-3 bg-slate-900/90 opacity-100 transition-opacity duration-1000 text-xs">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gov-wine text-white flex items-center justify-center font-bold text-[9px]">JG</div>
                                <div>
                                    <p class="text-[10px] font-bold text-white leading-none">julio_garces_crespo</p>
                                    <p class="text-[8px] text-slate-400">Hace 3 horas • Duaca, Lara</p>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-300 line-clamp-2 my-1">¡Seguimos de la mano de nuestra gente! Supervisando los trabajos de iluminación inteligente LED en las calles céntricas de la perla.</p>
                            <div class="flex items-center justify-between text-[9px] text-gov-accent border-t border-slate-800 pt-1.5">
                                <span><i class="fa-solid fa-heart text-gov-wine mr-1"></i> 324 Me gusta</span>
                                <span><i class="fa-solid fa-comment mr-1"></i> 18 comentarios</span>
                            </div>
                        </div>

                        <!-- Post IG 2 -->
                        <div id="ig-1" class="absolute inset-0 flex flex-col justify-between p-3 bg-slate-900/90 opacity-0 transition-opacity duration-1000 text-xs">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gov-wine text-white flex items-center justify-center font-bold text-[9px]">JG</div>
                                <div>
                                    <p class="text-[10px] font-bold text-white leading-none">julio_garces_crespo</p>
                                    <p class="text-[8px] text-slate-400">Hace 1 día • Baños de Guape</p>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-300 line-clamp-2 my-1">Plan de saneamiento ambiental ecológico activo en los Baños de Guape, recuperando el patrimonio hídrico municipal de Crespo.</p>
                            <div class="flex items-center justify-between text-[9px] text-gov-accent border-t border-slate-800 pt-1.5">
                                <span><i class="fa-solid fa-heart text-gov-wine mr-1"></i> 412 Me gusta</span>
                                <span><i class="fa-solid fa-comment mr-1"></i> 29 comentarios</span>
                            </div>
                        </div>

                        <!-- Post IG 3 -->
                        <div id="ig-2" class="absolute inset-0 flex flex-col justify-between p-3 bg-slate-900/90 opacity-0 transition-opacity duration-1000 text-xs">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gov-wine text-white flex items-center justify-center font-bold text-[9px]">JG</div>
                                <div>
                                    <p class="text-[10px] font-bold text-white leading-none">julio_garces_crespo</p>
                                    <p class="text-[8px] text-slate-400">Hace 2 días • Hospital de Duaca</p>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-300 line-clamp-2 my-1">Atención social integral y entrega técnica de insumos médicos de primera necesidad a los centros populares de salud.</p>
                            <div class="flex items-center justify-between text-[9px] text-gov-accent border-t border-slate-800 pt-1.5">
                                <span><i class="fa-solid fa-heart text-gov-wine mr-1"></i> 501 Me gusta</span>
                                <span><i class="fa-solid fa-comment mr-1"></i> 34 comentarios</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-center gap-1 mt-2">
                        <span id="ig-dot-0" onclick="setIgPost(0)" class="w-1.5 h-1.5 rounded-full bg-white cursor-pointer transition-all"></span>
                        <span id="ig-dot-1" onclick="setIgPost(1)" class="w-1.5 h-1.5 rounded-full bg-white/30 cursor-pointer transition-all"></span>
                        <span id="ig-dot-2" onclick="setIgPost(2)" class="w-1.5 h-1.5 rounded-full bg-white/30 cursor-pointer transition-all"></span>
                    </div>
                </div>
            </div>

            <!-- Centro: Dirección Física y Mapa Geográfico Leaflet -->
            <div class="flex flex-col">
                <h5 class="text-xs font-bold uppercase tracking-wider text-gov-accent mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot text-white/80"></i>
                    Sede de la Alcaldía
                </h5>
                <p class="text-[11px] text-slate-300 mb-2 leading-relaxed">
                    Avenida Tricentenaria, frente a la Plaza Bolívar, al lado del Santuario Diocesano San Juan Bautista. Duaca, Municipio Crespo, Estado Lara, Venezuela.
                </p>
                <div id="map" class="rounded border border-slate-800 shadow-sm overflow-hidden"></div>
                <p class="text-[8px] text-slate-500 mt-1 font-mono text-right">© OpenStreetMap Contributors • Leaflet JS</p>
            </div>

            <!-- Derecha: Contactos y Redes Oficiales (Sincronizado con el margen lateral de la izquierda) -->
            <div class="flex flex-col justify-start">
                <h5 class="text-xs font-bold uppercase tracking-wider text-gov-accent mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane text-white/80"></i>
                    Canales de Atención
                </h5>
                
                <div class="bg-slate-900/40 p-3 rounded border border-slate-800 relative shadow-sm">
                    <ul class="space-y-2.5 text-[11px] text-slate-300">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-phone text-gov-accent text-xs mt-0.5"></i>
                            <div>
                                <p class="font-bold text-white">Central de Atención Telefónica:</p>
                                <p>+58 (253) 491-1122 • 0412-5552737</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-envelope text-gov-accent text-xs mt-0.5"></i>
                            <div>
                                <p class="font-bold text-white">Correo Electrónico Oficial:</p>
                                <p class="underline text-slate-200">atencion@alcaldiadecrespolara.gob.ve</p>
                            </div>
                        </li>
                        <li class="pt-1.5 border-t border-slate-800 flex flex-col gap-1.5">
                            <p class="text-[9px] font-bold text-gov-slate uppercase tracking-wider">Enlaces Alcaldía y Alcalde:</p>
                            <div class="flex gap-2">
                                <a href="#" class="w-6 h-6 rounded bg-slate-800 hover:bg-gov-wine transition flex items-center justify-center text-[10px]" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="w-6 h-6 rounded bg-slate-800 hover:bg-gov-wine transition flex items-center justify-center text-[10px]" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="w-6 h-6 rounded bg-slate-800 hover:bg-gov-wine transition flex items-center justify-center text-[10px]" title="Telegram"><i class="fa-brands fa-telegram"></i></a>
                                <a href="#" class="w-6 h-6 rounded bg-slate-800 hover:bg-gov-wine transition flex items-center justify-center text-[10px]" title="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 text-center text-[10px] text-gov-slate flex flex-col sm:flex-row justify-between items-center gap-1">
            <p>© 2026 Alcaldía Bolivariana del Municipio Crespo. Todos los derechos reservados de conformidad con la ley venezolana.</p>
            <p>Estado Lara - "Tierra de Crepúsculos" - Venezuela 🇻🇪</p>
        </div>
    </footer>

    <!-- MODAL INFORMATIVO PRINCIPAL -->
    <div id="info-modal" class="fixed inset-0 bg-gov-dark/75 backdrop-blur-xs flex items-center justify-center p-4 z-50 hidden transition-all duration-200">
        <div class="bg-white rounded max-w-2xl w-full shadow-2xl border border-gov-border max-h-[90vh] overflow-y-auto transform scale-95 transition-transform duration-200" id="modal-content-area">
            
            <div id="modal-header-bg" class="bg-gov-light p-4 rounded-t flex justify-between items-center border-b border-gov-border">
                <div>
                    <span id="modal-tag" class="text-[9px] uppercase font-bold tracking-widest text-gov-wine bg-red-100 px-2 py-0.5 rounded">Municipio Crespo</span>
                    <h3 id="modal-title" class="text-lg font-extrabold text-gov-dark mt-1">Título de la sección</h3>
                </div>
                <button onclick="closeModal()" class="text-gov-slate hover:text-gov-wine transition text-lg p-1 focus:outline-none">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div id="modal-body-content" class="p-6 space-y-4 text-xs leading-relaxed text-gov-dark border-b border-gov-border">
                <!-- Inyección dinámica de contenido -->
            </div>

            <div class="p-3 bg-gov-light flex justify-end">
                <button onclick="closeModal()" class="bg-gov-wine text-white font-bold text-[10px] uppercase tracking-wide px-5 py-2 rounded hover:bg-red-800 transition duration-150">
                    Cerrar ventana
                </button>
            </div>
        </div>
    </div>

    <!-- ====================================================================
         MÓDULO DE CONTROLADORES LÓGICOS (VIRTUAL JS SCRIPT)
         ==================================================================== -->
    <script>
        // --- 1. CONFIGURACIÓN DEL MAPA ---
        let map;
        function initMap() {
            const duacaCoords = [10.291122, -69.162706]; 
            
            map = L.map('map', {
                center: duacaCoords,
                zoom: 16,
                zoomControl: true,
                attributionControl: false
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            const customIcon = L.divIcon({
                html: '<div class="bg-gov-wine text-white p-1 rounded-full border border-white flex items-center justify-center shadow" style="width: 24px; height: 24px;"><i class="fa-solid fa-building-columns text-[10px]"></i></div>',
                className: 'custom-div-icon',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            L.marker(duacaCoords, {icon: customIcon})
                .addTo(map)
                .bindPopup('<div class="text-[10px] font-bold font-sans text-gov-dark">Alcaldía de Crespo<br><span class="font-normal text-slate-500">Duaca, Estado Lara</span></div>')
                .openPopup();
        }

        // --- 2. GESTIÓN DEL CARRUSEL DE NOTICIAS ---
        let currentSlide = 0;
        const totalSlides = 4;
        const slideInterval = 3000;

        function showSlide(index) {
            for (let i = 0; i < totalSlides; i++) {
                const slide = document.getElementById(`slide-${i}`);
                const dot = document.getElementById(`dot-${i}`);
                if (i === index) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100', 'z-10');
                    dot.classList.remove('bg-white/40');
                    dot.classList.add('bg-white', 'w-12');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0');
                    dot.classList.remove('bg-white', 'w-12');
                    dot.classList.add('bg-white/40');
                }
            }
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function setSlide(index) {
            currentSlide = index;
            showSlide(currentSlide);
        }

        // --- 3. GESTIÓN DE INSTAGRAM SIMULADO ---
        let currentIgPost = 0;
        const totalIgPosts = 3;

        function showIgPost(index) {
            for (let i = 0; i < totalIgPosts; i++) {
                const post = document.getElementById(`ig-${i}`);
                const dot = document.getElementById(`ig-dot-${i}`);
                if (i === index) {
                    post.classList.remove('opacity-0');
                    post.classList.add('opacity-100', 'z-10');
                    dot.classList.remove('bg-white/30');
                    dot.classList.add('bg-white', 'scale-125');
                } else {
                    post.classList.remove('opacity-100', 'z-10');
                    post.classList.add('opacity-0');
                    dot.classList.remove('bg-white', 'scale-125');
                    dot.classList.add('bg-white/30');
                }
            }
        }

        function nextIgPost() {
            currentIgPost = (currentIgPost + 1) % totalIgPosts;
            showIgPost(currentIgPost);
        }

        function setIgPost(index) {
            currentIgPost = index;
            showIgPost(currentIgPost);
        }

        // --- 4. GESTIÓN DEL MENÚ MÓVIL ---
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // --- 5. BASE DE DATOS DE CONTENIDOS (MODALES) ---
        const infoData = {
            'simbolos-patrios': {
                tag: 'Municipio Crespo - Identidad',
                title: 'Símbolos Patrios Municipales',
                body: `
                    <div class="space-y-3">
                        <div class="flex justify-center mb-3">
                            <img src="IDENTIDAD CRESPO - ALCALDE_Mesa de trabajo 1_2.jpg" alt="Símbolo Patrio de Crespo" class="h-20 w-20 object-contain rounded bg-black p-1">
                        </div>
                        <div class="border-l-2 border-gov-wine pl-3">
                            <h4 class="font-bold text-gov-dark text-xs uppercase mb-1">La Bandera del Municipio Crespo</h4>
                            <p class="text-slate-600 text-[11px]">
                                Compuesta por tres franjas heráldicas que simbolizan el verdor de la cordillera del norte de Lara (cafetales productivos), el cielo puro que abriga al municipio, y el oro de la constancia de su "Pura Gente Buena".
                            </p>
                        </div>
                        <div class="border-l-2 border-gov-wine pl-3">
                            <h4 class="font-bold text-gov-dark text-xs uppercase mb-1">El Escudo de Armas Oficial</h4>
                            <p class="text-slate-600 text-[11px]">
                                Custodia la memoria de la resistencia indígena originaria, el perfil geográfico del Cerro de Barro Negro de Duaca, y corona el centro con una perla brillante que testifica heráldicamente su designación como la "La Perla del Norte".
                            </p>
                        </div>
                        <div class="border-l-2 border-gov-wine pl-3">
                            <h4 class="font-bold text-gov-dark text-xs uppercase mb-1">Himno del Municipio</h4>
                            <p class="text-slate-600 text-[11px]">
                                Composición lírica de profundo fervor patrio que celebra las luchas libertarias del municipio, su vocación agraria y el carácter noble y hospitalario de sus pobladores.
                            </p>
                        </div>
                    </div>
                `
            },
            'simbolos-naturales': {
                tag: 'Municipio Crespo - Flora y Fauna',
                title: 'Símbolos Naturales',
                body: `
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gov-light p-3 border border-gov-border rounded">
                            <span class="text-2xl block mb-1">🌳</span>
                            <h4 class="font-bold text-gov-dark text-xs uppercase">Árbol Emblemático</h4>
                            <p class="text-[10px] text-gov-wine font-semibold mb-1">El Cafeto</p>
                            <p class="text-slate-600 text-[10px]">
                                Constituye el pilar tradicional de la flora crespense y el orgullo económico de la región.
                            </p>
                        </div>
                        <div class="bg-gov-light p-3 border border-gov-border rounded">
                            <span class="text-2xl block mb-1">🌸</span>
                            <h4 class="font-bold text-gov-dark text-xs uppercase">Flor Emblemática</h4>
                            <p class="text-[10px] text-gov-wine font-semibold mb-1">Flor del Cafeto</p>
                            <p class="text-slate-600 text-[10px]">
                                Floración blanca y aromática que adorna cada año las colinas montañosas de Duaca.
                            </p>
                        </div>
                        <div class="bg-gov-light p-3 border border-gov-border rounded">
                            <span class="text-2xl block mb-1">🦜</span>
                            <h4 class="font-bold text-gov-dark text-xs uppercase">Ave Emblemática</h4>
                            <p class="text-[10px] text-gov-wine font-semibold mb-1">El Azulejo</p>
                            <p class="text-slate-600 text-[10px]">
                                Hermosa y vivaz ave de canto melódico que abunda en el ecosistema de Barro Negro.
                            </p>
                        </div>
                    </div>
                `
            },
            'lugares-turisticos': {
                tag: 'Municipio Crespo - Turismo',
                title: 'Destinos Turísticos Oficiales',
                body: `
                    <div class="space-y-3">
                        <p class="text-[11px] text-gov-slate">Guía simplificada de los principales destinos recreacionales e históricos:</p>
                        <div class="space-y-2">
                            <div class="bg-gov-light p-3 border border-gov-border rounded">
                                <h5 class="font-bold text-gov-dark text-xs">🏞️ Parque Nacional Recreacional "Baños de Guape"</h5>
                                <p class="text-slate-600 text-[11px] mt-0.5">Un pulmón ecológico natural en la ciudad de Duaca, con nacientes de aguas cristalinas ideales para el descanso y el turismo ecológico.</p>
                            </div>
                            <div class="bg-gov-light p-3 border border-gov-border rounded">
                                <h5 class="font-bold text-gov-dark text-xs">🌲 Bosque Protegido de Barro Negro</h5>
                                <p class="text-slate-600 text-[11px] mt-0.5">Zona de reserva forestal idónea para el senderismo guiado, la investigación biológica y el avistamiento de aves autóctonas.</p>
                            </div>
                            <div class="bg-gov-light p-3 border border-gov-border rounded">
                                <h5 class="font-bold text-gov-dark text-xs">⛪ Santuario Diocesano San Juan Bautista</h5>
                                <p class="text-slate-600 text-[11px] mt-0.5">Epicentro de la fe católica crespense y patrimonio histórico arquitectónico nacional ubicado frente a la Plaza Bolívar de Duaca.</p>
                            </div>
                        </div>
                    </div>
                `
            },
            'territorio': {
                tag: 'Municipio Crespo - Geografía',
                title: 'Territorio y Geografía',
                body: `
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-3 text-center">
                            <div class="bg-gov-light p-2.5 border border-gov-border">
                                <p class="text-[10px] text-gov-slate font-bold uppercase">Capital Municipal</p>
                                <p class="text-sm font-black text-gov-wine">Duaca</p>
                            </div>
                            <div class="bg-gov-light p-2.5 border border-gov-border">
                                <p class="text-[10px] text-gov-slate font-bold uppercase">División Parroquial</p>
                                <p class="text-sm font-black text-gov-wine">Freitez y J.M. Blanco</p>
                            </div>
                        </div>
                        <p class="text-slate-600 text-[11px] leading-relaxed">
                            El **Municipio Crespo** se localiza al norte del Estado Lara, colindando con el Estado Yaracuy. Cuenta con un relieve montañoso de valles idóneos para el cultivo del café. Su altitud promedia los 800 metros sobre el nivel del mar, lo que propicia un clima fresco y templado que cautiva a los visitantes.
                        </p>
                    </div>
                `
            },
            'alcalde-bio': {
                tag: 'Liderazgo Institucional',
                title: 'Alcalde Julio Garcés',
                body: `
                    <div class="flex flex-col md:flex-row gap-5 items-center">
                        <div class="w-32 h-20 flex items-center justify-center bg-white p-1 rounded border border-gov-border shadow-xs shrink-0">
                            <img src="JG ORIGINAL@4x.png" alt="Alcalde Julio Garcés" class="max-h-full max-w-full object-contain" onerror="this.src='https://placehold.co/120x80/081e43/ffffff?text=JG'">
                        </div>
                        <div class="space-y-1.5">
                            <h4 class="text-base font-bold text-gov-dark">Julio Garcés</h4>
                            <p class="text-[10px] text-gov-slate font-semibold uppercase">Alcalde del Municipio Crespo, Estado Lara</p>
                            <p class="text-slate-600 text-[11px] leading-relaxed">
                                Abocado al servicio del Poder Popular, promueve un modelo de desarrollo basado en el trabajo directo, el rescate de los espacios públicos y el fortalecimiento de la producción caficultora. Bajo su eslogan de gestión **"Sacándole el brillo a la Perla"**, lidera la transformación del municipio junto al pueblo de Crespo.
                            </p>
                        </div>
                    </div>
                `
            },
            'mision': {
                tag: 'Nosotros - Institucional',
                title: 'Misión Institucional',
                body: `
                    <div class="bg-gov-light p-4 border border-gov-border rounded">
                        <p class="text-slate-600 text-[11px] leading-relaxed">
                            Dirigir la planificación, administración y ejecución de las políticas públicas locales en el Municipio Crespo, promoviendo la participación protagónica del Poder Popular. Garantizamos la prestación óptima de servicios, el embellecimiento urbano y el impulso agroproductivo en absoluto apego al plan de desarrollo de la nación.
                        </p>
                    </div>
                `
            },
            'vision': {
                tag: 'Nosotros - Institucional',
                title: 'Visión Institucional',
                body: `
                    <div class="bg-gov-light p-4 border border-gov-border rounded">
                        <p class="text-slate-600 text-[11px] leading-relaxed">
                            Consolidar al Municipio Crespo como una potencia productiva, cafetalera, turística y autosustentable del Estado Lara, caracterizada por la transparencia administrativa, la modernización de servicios públicos de calidad y un pueblo organizado que decide de manera soberana su propio destino.
                        </p>
                    </div>
                `
            },
            'gestion-info': {
                tag: 'Nosotros - Institucional',
                title: 'Gestión "Sacándole el Brillo a la Perla"',
                body: `
                    <p class="text-slate-600 text-[11px] leading-relaxed">
                        Nuestra gestión municipal, bajo el liderazgo del Alcalde **Julio Garcés**, asume la modernización de servicios como prioridad absoluta:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pt-2">
                        <div class="p-3 border border-gov-border rounded bg-white text-center">
                            <span class="text-xl">🛣️</span>
                            <h6 class="font-bold text-[11px] mt-1 text-gov-dark">Vías e Iluminación</h6>
                            <p class="text-[10px] text-gov-slate mt-0.5">Asfaltado integral y colocación de luminarias LED en avenidas.</p>
                        </div>
                        <div class="p-3 border border-gov-border rounded bg-white text-center">
                            <span class="text-xl">☕</span>
                            <h6 class="font-bold text-[11px] mt-1 text-gov-dark">Apoyo Agrícola</h6>
                            <p class="text-[10px] text-gov-slate mt-0.5">Semillas, abonos e insumos para potenciar la caficultura local.</p>
                        </div>
                        <div class="p-3 border border-gov-border rounded bg-white text-center">
                            <span class="text-xl">🩺</span>
                            <h6 class="font-bold text-[11px] mt-1 text-gov-dark">Atención Social</h6>
                            <p class="text-[10px] text-gov-slate mt-0.5">Jornadas médicas gratuitas directas en cada caserío municipal.</p>
                        </div>
                    </div>
                `
            },
            'organigrama': {
                tag: 'Institucional - Estructura',
                title: 'Organigrama Funcional de la Alcaldía de Crespo',
                body: `
                    <div class="p-4 bg-gov-dark text-white rounded text-center space-y-3">
                        <div class="flex justify-center mb-3">
                            <img src="IDENTIDAD CRESPO - ALCALDE_Mesa de trabajo 1_2.jpg" alt="Logo de la Alcaldía de Crespo" class="h-16 w-16 object-cover rounded border border-slate-700">
                        </div>
                        <p class="text-[9px] text-gov-slate uppercase tracking-wider font-bold">Estructura Orgánica Ejecutiva</p>
                        
                        <div class="flex justify-center">
                            <div class="bg-white text-gov-dark font-extrabold px-4 py-2 border border-gov-border text-xs">
                                🏛️ Despacho del Alcalde Julio Garcés
                            </div>
                        </div>

                        <div class="h-4 w-px bg-slate-600 mx-auto"></div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-[10px]">
                            <div class="bg-slate-900 p-2 border border-slate-800">
                                <span class="font-bold text-white block">T1: Económica</span>
                                <p class="text-gov-slate mt-0.5">Agrícola y Comercio</p>
                            </div>
                            <div class="bg-slate-900 p-2 border border-slate-800">
                                <span class="font-bold text-white block">T2: Independencia</span>
                                <p class="text-gov-slate mt-0.5">Educación y Cultura</p>
                            </div>
                            <div class="bg-slate-900 p-2 border border-slate-800">
                                <span class="font-bold text-white block">T3: Paz y Seguridad</span>
                                <p class="text-gov-slate mt-0.5">Seguridad y Catastro</p>
                            </div>
                            <div class="bg-slate-900 p-2 border border-slate-800">
                                <span class="font-bold text-white block">T4: Social</span>
                                <p class="text-gov-slate mt-0.5">Salud y Familia</p>
                            </div>
                        </div>
                    </div>
                `
            },
            'tramite-informe': {
                tag: 'Rendición de Cuentas',
                title: 'Informe de Gestión Anual',
                body: `
                    <p class="text-slate-600 text-[11px] leading-relaxed">
                        Cumpliendo con la Ley Orgánica del Poder Público Municipal, ponemos a disposición de la ciudadanía los informes físicos y financieros de la gestión municipal para su libre examen:
                    </p>
                    <div class="bg-gov-light p-3 border border-gov-border rounded mt-2 space-y-1.5">
                        <p class="font-bold text-xs text-gov-dark">Descarga de Documentación Oficial:</p>
                        <a href="#" class="block text-gov-wine font-bold text-[11px] hover:underline"><i class="fa-regular fa-file-pdf mr-1"></i> Memoria y Cuenta de Gestión 2025 (PDF)</a>
                        <a href="#" class="block text-gov-wine font-bold text-[11px] hover:underline"><i class="fa-regular fa-file-pdf mr-1"></i> Balance de Inversión Pública (PDF)</a>
                    </div>
                `
            },
            'tramite-general': {
                tag: 'Trámites y Servicios',
                title: 'Guía de Trámites Comunes',
                body: `
                    <p class="text-slate-600 text-[11px]">
                        Requisitos oficiales para la obtención de licencias de funcionamiento urbano:
                    </p>
                    <div class="space-y-2 mt-2">
                        <div class="p-3 border border-gov-border rounded">
                            <h5 class="font-bold text-gov-dark text-[11px] uppercase">📋 Patente de Industria y Comercio</h5>
                            <p class="text-slate-500 text-[10px] mt-0.5">Requisitos: Registro de Comercio, solvencia municipal de inmuebles, RIF vigente y pago de tasa administrativa correspondiente.</p>
                        </div>
                        <div class="p-3 border border-gov-border rounded">
                            <h5 class="font-bold text-gov-dark text-[11px] uppercase">🏗️ Permiso de Construcción y Reparaciones</h5>
                            <p class="text-slate-500 text-[10px] mt-0.5">Requisitos: Título de propiedad certificado, planos del proyecto firmados por ingeniero colegiado y solvencia catastral municipal.</p>
                        </div>
                    </div>
                `
            },
            'tramite-recaudacion': {
                tag: 'Impuestos Municipales',
                title: 'Recaudación de Tributos / SEDEMATRI',
                body: `
                    <p class="text-slate-600 text-[11px]">
                        La recaudación fiscal del Municipio Crespo se gestiona a través del Servicio Descentralizado de Administración Tributaria (SEDEMATRI) para su inversión directa en mejoras públicas:
                    </p>
                    <div class="bg-gov-light p-3 border border-gov-border rounded mt-2">
                        <h5 class="font-bold text-gov-dark text-xs mb-1">Métodos de Declaración y Pago</h5>
                        <p class="text-slate-500 text-[11px] leading-relaxed">
                            La declaración de ingresos brutos de actividades económicas puede tramitarse de manera digital bancaria o directamente en las taquillas de recaudación autorizadas en la sede del ayuntamiento.
                        </p>
                    </div>
                `
            },
            'tramite-trimestres': {
                tag: 'Finanzas Públicas',
                title: 'Presupuesto y Distribución Trimestral',
                body: `
                    <p class="text-slate-600 text-[11px]">
                        La planificación presupuestaria se asigna físicamente en 4 trimestres para responder de forma eficaz a las necesidades de servicios y de las comunidades organizadas:
                    </p>
                    <div class="grid grid-cols-2 gap-2 text-center pt-2">
                        <div class="p-2 border border-gov-border rounded">
                            <span class="font-bold text-[10px] block text-gov-wine">Trimestre I</span>
                            <span class="text-[9px] text-gov-slate">Mantenimiento de vías públicas</span>
                        </div>
                        <div class="p-2 border border-gov-border rounded">
                            <span class="font-bold text-[10px] block text-gov-wine">Trimestre II</span>
                            <span class="text-[9px] text-gov-slate">Inversión agrícola cafetalera</span>
                        </div>
                        <div class="p-2 border border-gov-border rounded">
                            <span class="font-bold text-[10px] block text-gov-wine">Trimestre III</span>
                            <span class="text-[9px] text-gov-slate">Salud y programas comunitarios</span>
                        </div>
                        <div class="p-2 border border-gov-border rounded">
                            <span class="font-bold text-[10px] block text-gov-wine">Trimestre IV</span>
                            <span class="text-[9px] text-gov-slate">Cultura y dotación invernal</span>
                        </div>
                    </div>
                `
            },
            'tramite-civil': {
                tag: 'Registro Civil',
                title: 'Trámites de Registro Civil de Crespo',
                body: `
                    <p class="text-slate-600 text-[11px] leading-relaxed">
                        Los servicios del Registro Civil municipal son de carácter gratuito y garantizan el derecho a la identidad civil de los crespenses:
                    </p>
                    <div class="space-y-2 mt-2">
                        <div class="p-2.5 border border-gov-border rounded bg-gov-light">
                            <p class="font-bold text-gov-dark text-xs">👶 Actas de Nacimiento</p>
                            <p class="text-[10px] text-slate-500">Requisitos: Certificado médico de nacimiento vivo original, cédula de identidad vigente de los padres y dos testigos.</p>
                        </div>
                        <div class="p-2.5 border border-gov-border rounded bg-gov-light">
                            <p class="font-bold text-gov-dark text-xs">💍 Uniones Estables y Matrimonios</p>
                            <p class="text-[10px] text-slate-500">Requisitos: Copias de cédula vigentes de los contrayentes, actas de nacimiento certificadas y carta de residencia oficial vigente.</p>
                        </div>
                    </div>
                `
            }
        };

        // --- 6. ACCIONES DE MODALES ---
        function openModal(key) {
            const modal = document.getElementById('info-modal');
            const tag = document.getElementById('modal-tag');
            const title = document.getElementById('modal-title');
            const body = document.getElementById('modal-body-content');
            const contentArea = document.getElementById('modal-content-area');

            const data = infoData[key];
            if (data) {
                tag.innerText = data.tag;
                title.innerText = data.title;
                body.innerHTML = data.body;

                modal.classList.remove('hidden');
                setTimeout(() => {
                    contentArea.classList.remove('scale-95');
                    contentArea.classList.add('scale-100');
                }, 50);
            }
        }

        function openDireccion(nombre, transformacion, descripcion) {
            const modal = document.getElementById('info-modal');
            const tag = document.getElementById('modal-tag');
            const title = document.getElementById('modal-title');
            const body = document.getElementById('modal-body-content');
            const contentArea = document.getElementById('modal-content-area');

            tag.innerText = `Dirección Municipal • ${transformacion}`;
            title.innerText = nombre;
            body.innerHTML = `
                <div class="space-y-3">
                    <div class="bg-gov-light p-4 border border-gov-border text-gov-dark">
                        <h4 class="font-bold text-xs uppercase text-gov-wine mb-1">Misión de la Dirección</h4>
                        <p class="text-slate-600 text-[11px] leading-relaxed">${descripcion}</p>
                    </div>
                    <div class="p-4 border border-gov-border rounded bg-white">
                        <h4 class="font-bold text-xs uppercase text-gov-dark mb-1">Ejes de Acción Local</h4>
                        <ul class="text-[11px] text-slate-500 list-disc pl-4 space-y-1">
                            <li>Atención priorizada de las solicitudes comunales de Crespo.</li>
                            <li>Ejecución de los lineamientos del plan de transformación nacional de Venezuela.</li>
                            <li>Coordinación de proyectos estratégicos junto al Alcalde Julio Garcés.</li>
                        </ul>
                    </div>
                </div>
            `;

            modal.classList.remove('hidden');
            setTimeout(() => {
                contentArea.classList.remove('scale-95');
                contentArea.classList.add('scale-100');
            }, 50);
        }

        function closeModal() {
            const modal = document.getElementById('info-modal');
            const contentArea = document.getElementById('modal-content-area');

            contentArea.classList.remove('scale-100');
            contentArea.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150);
        }

        // --- 7. APARTADO RESPONSIVO MÓVIL DE LAS 7T ---
        function toggleMobile7T() {
            const list = document.getElementById('mobile-7t-list');
            list.classList.toggle('hidden');
        }

        function buildMobile7TMenu() {
            const container = document.getElementById('mobile-7t-list');
            const allItems = [
                ['Dirección de Desarrollo Agrícola', 'T1: Económica', 'Encargada de potenciar la siembra de café, hortalizas y apoyo técnico.'],
                ['Dirección de Comercio y Emprendimiento', 'T1: Económica', 'Regula e impulsa actividades comerciales locales y nuevos registros.'],
                ['Enlace Procesador Cafetalero', 'T1: Económica', 'Coordinación con las torrefactoras locales para el impulso de café de Crespo.'],
                ['Dirección de Servicios Públicos y Patrimonio', 'T2: Independencia', 'Fomenta el arraigo histórico, cuidado escolar y casco colonial de Duaca.'],
                ['Oficina de Ciencia y Tecnología', 'T2: Independencia', 'Promueve el acceso a la tecnología, infocentros comunitarios.'],
                ['Dirección de Cultura "La Perla"', 'T2: Independencia', 'Preserva el folclor crespense y las festividades tradicionales.'],
                ['Dirección de Seguridad Ciudadana', 'T3: Paz y Seguridad', 'Planes preventivos y enlace con fuerzas policiales.'],
                ['Gestión de Riesgos y PC', 'T3: Paz y Seguridad', 'Prevención y atención en zonas geográficas vulnerables.'],
                ['Dirección de Catastro Municipal', 'T3: Paz y Seguridad', 'Límites, zonificación y registro catastral de los inmuebles.'],
                ['Dirección de Salud y Bienestar', 'T4: Social', 'Atención médica primaria y jornadas rurales gratuitas.'],
                ['Instituto de la Mujer y Familia', 'T4: Social', 'Empoderamiento, asesorías e impulso de la familia en Crespo.'],
                ['Dirección de Vivienda', 'T4: Social', 'Asistencia para mejoras habitacionales a familias vulnerables.'],
                ['Comunas y Consejos Comunales', 'T5: Poder Popular', 'Articulación de proyectos de desarrollo soberano comunal.'],
                ['Oficina de Atención Ciudadana', 'T5: Poder Popular', 'Gestión de reclamos e informes enviados por la ciudadanía.'],
                ['Planificación Participativa', 'T5: Poder Popular', 'Formulación de presupuestos soberanos con asambleas locales.'],
                ['Ecosocialismo y Reciclaje', 'T6: Ecología', 'Cuidado ambiental y planes de reciclaje en Barro Negro.'],
                ['Parques y Áreas Verdes', 'T6: Ecología', 'Saneamiento y embellecimiento de plazas urbanas en Duaca.'],
                ['Aguas y Saneamiento', 'T6: Ecología', 'Optimización de acueductos locales e infraestructuras de agua.'],
                ['Relaciones Interinstitucionales', 'T7: Geopolítica', 'Enlace directo con gobernación y entes ministeriales.'],
                ['Cooperación e Inversión', 'T7: Geopolítica', 'Convenios de intercambio agrícola, técnico y comercial.'],
                ['Desarrollo Comunitario', 'T7: Geopolítica', 'Estudio geopolítico territorial e impulso de autogestión de micro-redes.']
            ];

            allItems.forEach(item => {
                const link = document.createElement('a');
                link.href = "#";
                link.className = "block text-[11px] bg-white/5 p-2 rounded hover:bg-white/10 text-slate-200 truncate";
                link.innerText = `${item[1].split(':')[0]} • ${item[0]}`;
                link.onclick = function() {
                    openDireccion(item[0], item[1], item[2]);
                    toggleMobileMenu();
                };
                container.appendChild(link);
            });
        }

        // --- 8. CICLO DE VIDA INICIAL ---
        window.onload = function() {
            initMap();
            setInterval(nextSlide, slideInterval);
            setInterval(nextIgPost, 4500);
            buildMobile7TMenu();
        };
    </script>
</body>
</html>