# Documentación de API - Gestión de Integrantes ICALA ------------- generada POR COPILOT Y REVISADO POR MI

## Endpoints de la Aplicación

### Autenticación

#### POST /auth
- **Descripción**: Autentica a un administrador
- **Parámetros**: email, password   
- **Respuesta**: Redirección con mensaje de éxito/error

#### GET /logout
- **Descripción**: Cierra la sesión del administrador
- **Respuesta**: Redirección a /login

### Usuarios

#### POST /Usuario/store
- **Descripción**: Crea un nuevo usuario/integrante
- **Parámetros**: nombre, fechanacimiento, telefono, fechaingreso
- **Validaciones**: Campos requeridos, formato de fechas

#### GET /Usuario/crear
- **Descripción**: Muestra formulario para crear usuario
- **Respuesta**: Vista crearUsuario

#### GET /Usuario/editar/{uuid}
- **Descripción**: Muestra formulario para editar usuario
- **Parámetros**: uuid del usuario
- **Respuesta**: Vista editarUsuario con datos del usuario

#### PUT /Usuario/update/{uuid}
- **Descripción**: Actualiza datos de un usuario
- **Parámetros**: uuid, nombre, fechanacimiento, telefono, fechaingreso

#### DELETE /Usuario/borrar/{uuid}
- **Descripción**: Elimina un usuario
- **Parámetros**: uuid del usuario

#### GET /usuario/buscar
- **Descripción**: Busca usuarios por campo
- **Parámetros**: campo (nombre, telefono, fechanacimiento)
- **Respuesta**: Vista home con resultados

### Planillas

#### GET /planillas
- **Descripción**: Lista todas las planillas
- **Respuesta**: Vista de planillas con usuarios

#### POST /planillas/crear
- **Descripción**: Crea una nueva planilla
- **Parámetros**: IdUsuario (encargado), TipoServicio

#### GET /planillas/ver/{uuid}
- **Descripción**: Muestra detalle de una planilla
- **Parámetros**: uuid de la planilla
- **Respuesta**: Vista con planilla y usuarios marcados

#### PUT /planilla/Asistencia/{planillaUUID}/{usuarioUUID}
- **Descripción**: Marca/desmarca asistencia de un usuario
- **Validación**: Fecha de ingreso del usuario vs fecha de planilla

#### DELETE /planillas/borrar/{uuid}
- **Descripción**: Elimina una planilla
- **Parámetros**: uuid de la planilla

### Eventos

#### GET /Eventos
- **Descripción**: Lista todos los eventos
- **Respuesta**: Vista de eventos

#### POST /Eventos/crear
- **Descripción**: Crea un nuevo evento
- **Parámetros**: nombre, fecha_inicio, descripcion, admin_encargado

#### GET /Evento/Editar/{uuid}
- **Descripción**: Muestra formulario para editar evento
- **Parámetros**: uuid del evento

#### PUT /Evento/actualizar/{uuid}
- **Descripción**: Actualiza un evento
- **Parámetros**: uuid, datos del evento

#### DELETE /Evento/borrar/{uuid}
- **Descripción**: Elimina un evento
- **Parámetros**: uuid del evento

### Reportes

#### GET /Reportes
- **Descripción**: Muestra reportes generales
- **Respuesta**: Vista con reportes de asistencia, nuevos usuarios, cumpleaños

#### POST /Reportes
- **Descripción**: Genera reportes para una fecha específica
- **Parámetros**: fecha (opcional, por defecto hoy)

### Vistas Públicas

#### GET /portal
- **Descripción**: Vista pública para usuarios (sin login)
- **Respuesta**: Vista homeUsuarios con eventos

#### GET /login
- **Descripción**: Formulario de login
- **Respuesta**: Vista auth/login

## Middleware

### check.auth
- **Descripción**: Verifica que el usuario esté autenticado como admin
- **Aplicado a**: Todas las rutas protegidas

## Servicios

### AuthService
- `authenticate(array $credentials)`: Verifica credenciales
- `logout()`: Cierra sesión

### UsuarioService
- `store(array $data)`: Crea usuario
- `obtenerUsuarios()`: Obtiene todos los usuarios
- `update(string $uuid, array $data)`: Actualiza usuario
- `buscarUUID(string $uuid)`: Busca usuario por UUID
- `eliminarUUID(string $uuid)`: Elimina usuario
- `buscarPorCampo(string $campo)`: Busca usuarios por campo

### PlanillasService
- `store(array $data)`: Crea planilla
- `obtenerPlanillas()`: Obtiene planillas con usuarios
- `obtenerPlanillasUUID(string $uuid)`: Obtiene planilla específica
- `marcarAsistencia(string $planillaUUID, string $usuarioUUID)`: Toggle asistencia
- `eliminar(string $planillaUUID)`: Elimina planilla

### EventosService
- `store(array $request)`: Crea evento
- `obtenerEvento(string $uuid)`: Obtiene evento específico
- `obtenerEventos()`: Obtiene todos los eventos (con cache)
- `actualizarEvento(string $uuid, array $data)`: Actualiza evento
- `eliminarEvento(string $uuid)`: Elimina evento

### ReportesService
- `usuariosAsistencia()`: Reporte de asistencia por usuario
- `reportesUsuarios(Carbon $fecha)`: Reportes generales para fecha
- `integrantesNuevos(Carbon $fecha)`: Nuevos integrantes en mes
- `cumpleAniosHoy(Carbon $fecha)`: Cumpleaños del día
- `cumpleAniosManana(Carbon $fecha)`: Cumpleaños de mañana

### AdminsService
- `obtenerAdmins()`: Lista de administradores

## Modelos y Relaciones

### Usuario
- **Relaciones**: planillas (muchos a muchos)
- **Atributos**: edad (calculado)

### Planilla
- **Relaciones**: usuarios (muchos a muchos), encargado (uno a muchos con Usuario)
- **Atributos**: diaSemana (calculado)

### Evento
- **Relaciones**: admin (uno a muchos con Admin)

### Admin
- Extiende Authenticatable de Laravel

## Validaciones

### AuthRequest
- email: requerido, email, max:255
- password: requerido

### storeUsuarioRequest
- nombre: requerido, string, max:255
- fechanacimiento: requerido, date, before:today
- telefono: requerido, string, max:20
- fechaingreso: requerido, date

### UpdateUsuarioRequest
- nombre: requerido, string, max:255
- fechanacimiento: requerido, date, before:today
- fechaingreso: requerido, date
- telefono: requerido, string, max:20

### BuscarUsuarioRequest
- campo: requerido, string, min:1