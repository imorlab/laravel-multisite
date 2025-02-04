# Laravel Multisite

Un sistema de gestión de múltiples sitios web para espectáculos teatrales, construido con Laravel y Livewire.

## Características

- **Gestión Multi-sitio**: Administra múltiples sitios web desde una única instalación
- **Contenido Multilingüe**: Soporte completo para español e inglés
- **Componentes Dinámicos**: 
  - Páginas personalizables
  - Noticias
  - Staff (/staff)
  - Elenco (/cast)
  - Equipo creativo (/creative-team)
- **URLs Amigables**: Rutas semánticas para cada tipo de contenido
- **Panel de Administración**: Gestión completa del contenido
- **Diseño Responsivo**: Interfaz moderna y adaptable

## Requisitos

- PHP >= 8.2
- MySQL >= 8.0
- Composer
- Node.js y NPM

## Instalación

1. Clonar el repositorio:
```bash
git clone [url-del-repositorio]
cd laravel-multisite
```

2. Instalar dependencias:
```bash
composer install
npm install
```

3. Configurar el entorno:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar la base de datos en `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_multisite
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrar y poblar la base de datos:
```bash
php artisan migrate:fresh --seed
```

6. Compilar assets:
```bash
npm run dev
```

7. Configurar host virtual:
```
127.0.0.1 laravel-multisite.test
```

Los sitios serán accesibles de la siguiente manera:
- Sitio principal: https://laravel-multisite.test
- Otros sitios: https://laravel-multisite.test/{nombre-del-sitio} (ejemplo: https://laravel-multisite.test/phantom)

## Estructura del Proyecto

- `/app/Http/Controllers`: Controladores de la aplicación
- `/app/Livewire`: Componentes Livewire
- `/app/Models`: Modelos de la aplicación
- `/database/migrations`: Migraciones de la base de datos
- `/database/seeders`: Seeders para datos de prueba
- `/resources/views`: Vistas Blade
- `/routes`: Definiciones de rutas

## Estructura de URLs

El sistema utiliza una estructura de URLs semántica para cada tipo de contenido:

- **Elenco**: `/cast` (listado) y `/cast/{slug}` (perfil individual)
- **Equipo Creativo**: `/creative-team` (listado) y `/creative-team/{slug}` (perfil individual)
- **Staff**: `/staff` (listado) y `/staff/{slug}` (perfil individual)
- **Noticias**: `/news` (listado) y `/news/{slug}` (noticia individual)
- **Páginas**: `/pages/{slug}`

Para sitios con dominio propio, se utiliza el mismo patrón precedido por el dominio:
`http://{dominio}/{seccion}/{slug}`

## Modelos Principales

- `Site`: Gestiona los sitios web
- `Page`: Páginas de contenido
- `News`: Noticias y actualizaciones
- `Staff`: Miembros del equipo
- `Cast`: Elenco del espectáculo
- `CreativeTeam`: Equipo creativo

## Características de Internacionalización

- Sistema de cambio de idioma en tiempo real
- Contenido traducible para todos los modelos
- Interfaz de usuario bilingüe

## Desarrollo

Para ejecutar el entorno de desarrollo:

```bash
php artisan serve
npm run dev
```

## Pruebas

Para ejecutar las pruebas:

```bash
php artisan test
```

## Créditos

Desarrollado por [Tu Nombre/Empresa]

## Licencia

Este proyecto está licenciado bajo [tu licencia].
