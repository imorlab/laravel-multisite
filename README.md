# Laravel Multisite

Un sistema de gestión de múltiples sitios web para espectáculos teatrales, construido con Laravel y Livewire.

## Características

- **Gestión Multi-sitio**: Administra múltiples sitios web desde una única instalación
- **Contenido Multilingüe**: 
  - Soporte completo para español e inglés
  - Cambio de idioma dinámico sin recargar la página
  - Traducciones para títulos, contenido, descripciones y más
- **Componentes Dinámicos**: 
  - Páginas personalizables
  - Noticias con imágenes y contenido rico
  - Staff (/staff)
  - Elenco (/cast)
  - Equipo creativo (/creative-team)
- **URLs Amigables**: Rutas semánticas para cada tipo de contenido
- **Panel de Administración**: Gestión completa del contenido
- **Diseño Responsivo**: Interfaz moderna y adaptable
- **Arquitectura Modular**:
  - Componentes Livewire para UI dinámica
  - Traits reutilizables para funcionalidad común
  - Modelos con soporte multilingüe integrado

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
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. Migrar la base de datos:
```bash
php artisan migrate --seed
```

6. Compilar assets:
```bash
npm run dev
```

## Estructura del Proyecto

### Modelos
- `Site`: Gestiona los sitios web y su contenido multilingüe
- `Page`: Páginas dinámicas con contenido traducible
- `News`: Noticias y actualizaciones con soporte multilingüe
- `Person`: Gestión de staff, elenco y equipo creativo

### Componentes Livewire
- `ShowsList`: Lista de shows/sitios disponibles
- `NewsList`: Noticias con actualización dinámica
- `PeopleList`: Lista de personas filtrada por tipo
- `ShowPage`: Visualización de páginas con contenido traducible

### Traits
- `WithTranslations`: Proporciona funcionalidad de traducción a componentes

### Middleware
- `SetLocale`: Gestiona el cambio de idioma en la aplicación
- `DetectSite`: Detecta y configura el sitio actual basado en el dominio

### Estructura de URLs

El sistema utiliza una estructura de URLs semántica para cada tipo de contenido:

- **Elenco**: `/cast` (listado) y `/cast/{slug}` (perfil individual)
- **Equipo Creativo**: `/creative-team` (listado) y `/creative-team/{slug}` (perfil individual)
- **Staff**: `/staff` (listado) y `/staff/{slug}` (perfil individual)
- **Noticias**: `/news` (listado) y `/news/{slug}` (noticia individual)
- **Páginas**: `/pages/{slug}`

Para sitios con dominio propio, se utiliza el mismo patrón precedido por el dominio:
`http://{dominio}/{seccion}/{slug}`

## Contribuir

1. Fork el repositorio
2. Crear una rama para tu característica (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.
