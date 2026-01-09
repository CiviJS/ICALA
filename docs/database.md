# Documentación de Base de Datos - Gestión de Integrantes ICALA

## Esquema de Base de Datos

### Tabla: usuario
```sql
CREATE TABLE usuario (
    uuid CHAR(36) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    fechanacimiento DATE NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    fechaingreso DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Campos:**
- `uuid`: Identificador único (UUID)
- `nombre`: Nombre completo del integrante
- `fechanacimiento`: Fecha de nacimiento
- `telefono`: Número de teléfono
- `fechaingreso`: Fecha de ingreso a la iglesia

### Tabla: planilla
```sql
CREATE TABLE planilla (
    uuid CHAR(36) PRIMARY KEY,
    fechacreacion DATETIME NOT NULL,
    usuarioacargo CHAR(36) NOT NULL,
    tipodeactividad VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (usuarioacargo) REFERENCES usuario(uuid)
);
```

**Campos:**
- `uuid`: Identificador único (UUID)
- `fechacreacion`: Fecha y hora de creación de la planilla
- `usuarioacargo`: UUID del usuario encargado
- `tipodeactividad`: Tipo de servicio/actividad

### Tabla: evento
```sql
CREATE TABLE evento (
    uuid CHAR(36) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    fecha_inicio DATETIME NOT NULL,
    descripcion TEXT,
    admin_encargado BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (admin_encargado) REFERENCES admins(id)
);
```

**Campos:**
- `uuid`: Identificador único (UUID)
- `nombre`: Nombre del evento
- `fecha_inicio`: Fecha y hora de inicio
- `descripcion`: Descripción del evento
- `admin_encargado`: ID del administrador encargado

### Tabla: usuario_planilla
```sql
CREATE TABLE usuario_planilla (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    UUIDplanilla CHAR(36) NOT NULL,
    UUIDusuario CHAR(36) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (UUIDplanilla) REFERENCES planilla(uuid),
    FOREIGN KEY (UUIDusuario) REFERENCES usuario(uuid),
    UNIQUE KEY unique_asistencia (UUIDplanilla, UUIDusuario)
);
```

**Campos:**
- `id`: ID auto-incremental
- `UUIDplanilla`: UUID de la planilla
- `UUIDusuario`: UUID del usuario
- **Restricción única**: Un usuario no puede tener múltiples registros de asistencia en la misma planilla

### Tabla: admins
```sql
CREATE TABLE admins (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Campos:**
- `id`: ID auto-incremental
- `name`: Nombre del administrador
- `email`: Email único
- `password`: Contraseña hasheada
- `remember_token`: Token para "recordar sesión"

## Relaciones

### Diagrama de Relaciones
```
admins (1) -----> (*) evento
                    |
                    | admin_encargado

usuario (*) <-----> (*) planilla
    |                       |
    | usuarioacargo         |
    |                       |
    +-----------------------+
        usuario_planilla
```

### Detalles de Relaciones

1. **Admin → Eventos** (Uno a Muchos)
   - Un administrador puede estar encargado de múltiples eventos
   - Un evento tiene un solo administrador encargado

2. **Usuario → Planilla** (Muchos a Muchos)
   - Un usuario puede asistir a múltiples planillas
   - Una planilla puede tener múltiples usuarios asistentes
   - Relación gestionada por tabla pivote `usuario_planilla`

3. **Usuario → Planilla** (Uno a Muchos, Encargado)
   - Un usuario puede ser encargado de múltiples planillas
   - Una planilla tiene un solo usuario encargado
   - Relación directa en campo `usuarioacargo`

## Migraciones

### Orden de Ejecución
1. `0001_01_01_000000_create_users_table.php` - Tabla users (Laravel estándar)
2. `0001_01_01_000001_create_cache_table.php` - Tabla cache
3. `0001_01_01_000002_create_jobs_table.php` - Tabla jobs
4. Migraciones personalizadas para: usuario, planilla, evento, usuario_planilla, admins

## Índices y Optimizaciones

### Índices Recomendados
- `usuario(fechaingreso)` - Para consultas de nuevos integrantes
- `usuario(fechanacimiento)` - Para consultas de cumpleaños
- `planilla(fechacreacion)` - Para ordenamiento por fecha
- `evento(fecha_inicio)` - Para ordenamiento por fecha
- `usuario_planilla(UUIDplanilla, UUIDusuario)` - UNIQUE para evitar duplicados

## Consultas Comunes

### Obtener usuarios con asistencia
```sql
SELECT u.nombre, COUNT(up.id) as asistencias
FROM usuario u
LEFT JOIN usuario_planilla up ON u.uuid = up.UUIDusuario
GROUP BY u.uuid, u.nombre
ORDER BY asistencias DESC;
```

### Planillas por mes
```sql
SELECT COUNT(*) as total_planillas, MONTH(fechacreacion) as mes
FROM planilla
WHERE YEAR(fechacreacion) = YEAR(CURDATE())
GROUP BY MONTH(fechacreacion);
```

### Cumpleaños del mes
```sql
SELECT nombre, fechanacimiento
FROM usuario
WHERE MONTH(fechanacimiento) = MONTH(CURDATE())
ORDER BY DAY(fechanacimiento);
```

## Configuración de Conexión

### .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iglesia
DB_USERNAME=usuario
DB_PASSWORD=password
```

### Alternativa SQLite (desarrollo)
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

## Seeds y Factories

### DatabaseSeeder
- Ejecuta seeds específicos del proyecto

### UserFactory (Laravel estándar)
- Para testing y desarrollo

## Backup y Restauración

### Comando de backup recomendado
```bash
mysqldump -u usuario -p iglesia > backup_$(date +%Y%m%d_%H%M%S).sql
```

### Restauración
```bash
mysql -u usuario -p iglesia < backup_file.sql
```