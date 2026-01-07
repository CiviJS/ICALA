# Gestión de Integrantes - ICALA

## Descripción del Proyecto

Esta es una aplicación web desarrollada en Laravel para la gestión de integrantes de la iglesia ICALA. Permite administrar usuarios (integrantes), planillas de asistencia, eventos y generar reportes relacionados con la asistencia y actividades de la iglesia.

## Tecnologías Utilizadas

- **Backend**: Laravel 12.0 con PHP 8.2+
- **Frontend**: Blade templates, Tailwind CSS, Vite
- **Base de Datos**: MySQL (configurado para usar SQLite en desarrollo)
- **Autenticación**: Laravel Sanctum / Auth
- **Cache**: Laravel Cache (con soporte para Redis, Memcached, etc.)
- **Testing**: PHPUnit

## Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL o SQLite

## Instalación y Configuración

1. **Clonar el repositorio**:
   ```bash
   git clone <url-del-repositorio>
   cd Iglesia
   ```

2. **Instalar dependencias de PHP**:
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**:
   ```bash
   npm install
   ```

4. **Configurar el entorno**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos**:
   - Editar el archivo `.env` con las credenciales de tu base de datos
   - Ejecutar las migraciones:
     ```bash
     php artisan migrate
     ```

6. **Construir assets**:
   ```bash
   npm run build
   ```

7. **Iniciar el servidor**:
   ```bash
   php artisan serve
   ```

   O usar el comando de desarrollo que incluye Vite:
   ```bash
   composer run dev
   ```

## Estructura del Proyecto

### Modelos (app/Models/)

- **Usuario**: Representa a los integrantes de la iglesia
  - Campos: nombre, fecha de nacimiento, teléfono, fecha de ingreso
  - Relaciones: pertenece a muchas planillas (asistencia)
  - Atributos calculados: edad

- **Planilla**: Registra las asistencias a servicios/actividades
  - Campos: fecha de creación, usuario a cargo, tipo de servicio
  - Relaciones: muchos a muchos con usuarios, pertenece a un encargado

- **Evento**: Gestiona eventos de la iglesia
  - Campos: nombre, fecha de inicio, descripción, admin encargado
  - Relaciones: pertenece a un admin

- **Admin**: Usuarios administradores (extiende Authenticatable)
  - Campos estándar de Laravel: name, email, password

- **usuario_planilla**: Tabla pivote para la relación muchos a muchos entre usuarios y planillas

### Servicios (app/Services/)

- **AuthService**: Maneja la autenticación de administradores
- **UsuarioService**: CRUD de usuarios, búsqueda por campos
- **PlanillasService**: Gestión de planillas y asistencia
- **EventosService**: CRUD de eventos con cache
- **AdminsService**: Obtención de lista de administradores
- **ReportesService**: Generación de reportes de asistencia, cumpleaños, nuevos integrantes

### Controladores (app/Http/Controllers/)

- **HomeController**: Maneja la página principal, login/logout, dashboard admin
- **UsuarioController**: CRUD completo de usuarios
- **PlanillaController**: Gestión de planillas y marcado de asistencia
- **ControlEventosController**: CRUD de eventos
- **ReportesController**: Visualización de reportes

### Rutas (routes/web.php)

- **Públicas**:
  - `/portal`: Vista de usuarios (sin login)
  - `/login`: Formulario de login
  - `/auth`: Procesamiento de login
  - `/logout`: Cierre de sesión

- **Protegidas** (middleware 'check.auth'):
  - `/`: Dashboard admin
  - `/planillas`: Gestión de planillas
  - `/usuario/*`: CRUD de usuarios
  - `/Reportes`: Reportes
  - `/Eventos`: Gestión de eventos

## Funcionalidades Principales

### Gestión de Usuarios
- Crear, editar, eliminar integrantes
- Búsqueda por nombre, teléfono o fecha de nacimiento
- Cálculo automático de edad
- Validación de fechas de ingreso vs asistencia

### Planillas de Asistencia
- Crear planillas para servicios/actividades
- Marcar asistencia de usuarios
- Validación de que usuarios no puedan asistir antes de su fecha de ingreso
- Visualización de planillas con usuarios asignados

### Eventos
- Crear y gestionar eventos de la iglesia
- Asignación de administradores encargados
- Cache de eventos para mejor performance

### Reportes
- Reporte de asistencia por usuario
- Conteo de planillas no asistidas
- Nuevos integrantes por mes
- Cumpleaños del día y del día siguiente

### Autenticación
- Login/logout de administradores
- Middleware de protección de rutas
- Sesiones seguras

## Base de Datos

### Migraciones Principales
- `users`: Tabla estándar de Laravel (no utilizada directamente)
- `usuario`: Integrantes de la iglesia
- `planilla`: Planillas de asistencia
- `evento`: Eventos
- `usuario_planilla`: Relación muchos a muchos
- `cache`, `jobs`, etc.: Tablas estándar de Laravel

### Relaciones
- Usuario ↔ Planilla: Muchos a muchos (usuario_planilla)
- Planilla → Usuario: Uno a muchos (encargado)
- Evento → Admin: Uno a muchos

## Desarrollo

### Comandos Útiles

- **Desarrollo**: `composer run dev` (servidor + Vite + queue + logs)
- **Testing**: `composer run test`
- **Build de producción**: `npm run render-build`
- **Setup inicial**: `composer run setup`

### Middleware Personalizado
- `check.auth`: Verifica autenticación de admin

### Observers
- `EventosObserver`: Observa cambios en el modelo Evento

## Despliegue

La aplicación está configurada para despliegue en Render.com con el script `render-build` que optimiza la aplicación para producción.

## Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agrega nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT.

## Soporte

Para soporte técnico o preguntas sobre el proyecto, contactar al equipo de desarrollo.
