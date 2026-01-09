# Guía de Desarrollo - Gestión de Integrantes ICALA

## Arquitectura de la Aplicación

### Patrón MVC con Servicios
La aplicación sigue el patrón Modelo-Vista-Controlador (MVC) de Laravel, con una capa adicional de Servicios para lógica de negocio.

```
Cliente HTTP
    ↓
Controladores (app/Http/Controllers/)
    ↓
Servicios (app/Services/) ← Lógica de negocio
    ↓
Modelos (app/Models/) ← ORM Eloquent
    ↓
Base de Datos
```

## Estructura de Archivos

```
app/
├── Http/
│   ├── Controllers/     # Controladores web
│   ├── Middleware/      # Middleware personalizado
│   └── Requests/        # Validaciones de formularios
├── Models/              # Modelos Eloquent
├── Services/            # Lógica de negocio
├── Observers/           # Observers de modelos
└── Providers/           # Service Providers

resources/
├── views/               # Plantillas Blade
│   ├── auth/           # Vistas de autenticación
│   ├── home/           # Vistas principales
│   ├── usuario/        # CRUD usuarios
│   ├── planilla/       # Gestión planillas
│   ├── reportes/       # Reportes
│   └── eventos/        # Gestión eventos
├── css/                # Estilos CSS
└── js/                 # JavaScript

routes/
└── web.php             # Definición de rutas

database/
├── migrations/         # Migraciones de BD
├── factories/          # Factories para testing
└── seeders/            # Seeds de datos
```

## Convenciones de Código

### Nombres de Clases y Métodos
- **Modelos**: PascalCase, singular (Usuario, Planilla)
- **Controladores**: PascalCase + Controller (UsuarioController)
- **Servicios**: PascalCase + Service (UsuarioService)
- **Métodos**: camelCase (obtenerUsuarios, marcarAsistencia)

### Rutas
- **Recursos**: `/usuarios`, `/planillas`, `/eventos`
- **Acciones**: `/crear`, `/editar/{id}`, `/borrar/{id}`
- **API**: Prefijo `/api/` para futuras APIs REST

### Base de Datos
- **Tablas**: snake_case, plural (usuarios, planillas)
- **Columnas**: snake_case (fecha_nacimiento, usuario_acargo)
- **Claves foráneas**: `id_tabla_referenciada` o `uuid_tabla_referenciada`

## Desarrollo Local

### Configuración Inicial
```bash
# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configurar BD y ejecutar migraciones
php artisan migrate
php artisan db:seed

# Construir assets
npm run build
```

### Servidor de Desarrollo
```bash
# Opción 1: Solo backend
php artisan serve

# Opción 2: Desarrollo completo (recomendado)
composer run dev
# Incluye: servidor PHP + Vite + Queue worker + Logs
```

### Comandos Útiles
```bash
# Limpiar cachés
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Ejecutar tests
php artisan test

# Crear nuevos elementos
php artisan make:model NuevoModelo
php artisan make:controller NuevoController
php artisan make:service NuevoService
php artisan make:request NuevoRequest
php artisan make:migration create_nueva_tabla
```

## Validaciones y Form Requests

### Creación de Form Request
```bash
php artisan make:request usuario/StoreUsuarioRequest
```

### Estructura de Validación
```php
public function rules(): array
{
    return [
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'fecha_nacimiento' => 'required|date|before:today',
    ];
}

public function messages(): array
{
    return [
        'nombre.required' => 'El nombre es obligatorio',
        'email.unique' => 'Este email ya está registrado',
    ];
}
```

## Servicios (Business Logic Layer)

### Patrón Service
Los servicios contienen la lógica de negocio y son inyectados en los controladores.

```php
// Definición del servicio
class UsuarioService
{
    public function store(array $data): Usuario
    {
        return Usuario::create($data);
    }
}

// Inyección en controlador
public function store(UsuarioService $service, StoreRequest $request)
{
    $service->store($request->validated());
    return redirect()->back()->with('success', 'Usuario creado');
}
```

### Beneficios
- **Separación de responsabilidades**: Controladores solo manejan HTTP
- **Reutilización**: Lógica compartida entre controladores
- **Testabilidad**: Servicios más fáciles de testear unitariamente
- **Inyección de dependencias**: Fácil mocking en tests

## Modelos Eloquent

### UUIDs
La aplicación usa UUIDs en lugar de IDs auto-incrementales para mayor seguridad.

```php
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Usuario extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
}
```

### Relaciones
```php
// Uno a muchos
public function encargado(): BelongsTo
{
    return $this->belongsTo(Usuario::class, 'usuarioacargo', 'uuid');
}

// Muchos a muchos
public function usuarios(): BelongsToMany
{
    return $this->belongsToMany(
        Usuario::class,
        'usuario_planilla',
        'uuidplanilla',
        'uuidusuario'
    );
}
```

### Atributos Calculados
```php
protected $appends = ['edad'];

public function getEdadAttribute(): int
{
    return Carbon::parse($this->fechanacimiento)->age;
}
```

## Cache y Optimización

### Cache de Eventos
```php
public function obtenerEventos(): Collection
{
    return Cache::remember('eventos_todo', 600, function () {
        return Evento::with('admin')->get();
    });
}
```

### Limpieza de Cache
```bash
php artisan cache:clear
```

## Testing

### Estructura de Tests
```
tests/
├── Feature/    # Tests de funcionalidades completas
└── Unit/       # Tests unitarios de clases individuales
```

### Ejemplo de Test
```php
class UsuarioServiceTest extends TestCase
{
    public function test_crear_usuario()
    {
        $service = new UsuarioService();
        $data = [
            'nombre' => 'Juan Pérez',
            'fechanacimiento' => '1990-01-01',
            'telefono' => '123456789',
            'fechaingreso' => '2023-01-01'
        ];

        $usuario = $service->store($data);

        $this->assertInstanceOf(Usuario::class, $usuario);
        $this->assertEquals('Juan Pérez', $usuario->nombre);
    }
}
```

### Ejecutar Tests
```bash
# Todos los tests
php artisan test

# Tests específicos
php artisan test tests/Unit/UsuarioServiceTest.php

# Con coverage
php artisan test --coverage
```

## Despliegue

### Build de Producción
```bash
composer run render-build
```

Este comando:
1. Instala dependencias sin dev
2. Optimiza autoloader
3. Instala dependencias npm
4. Construye assets
5. Cachea configuración, rutas y vistas

### Variables de Entorno
```env
APP_NAME="Gestión ICALA"
APP_ENV=production
APP_KEY=base64:key
APP_DEBUG=false
APP_URL=https://tu-dominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=iglesia_prod
DB_USERNAME=prod_user
DB_PASSWORD=secure_password

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

## Debugging

### Logs
```php
// En servicios o controladores
Log::info('Usuario creado', ['user_id' => $user->id]);

// Ver logs
tail -f storage/logs/laravel.log
```

### Laravel Debugbar
```bash
composer require barryvdh/laravel-debugbar --dev
```

### Dump and Die
```php
dd($variable); // Para debugging
dump($variable); // Para debugging sin detener ejecución
```

## Seguridad

### Autenticación
- Usa el sistema de autenticación estándar de Laravel
- Middleware `auth` para rutas protegidas
- Hashing automático de passwords

### Validación
- Server-side validation con Form Requests
- Sanitización automática de inputs
- Protección CSRF en formularios

### Autorización
- Gates y Policies para control de acceso granular
- Middleware personalizado `check.auth`

## Mantenimiento

### Tareas Programadas
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('cache:clear')->daily();
    $schedule->command('backup:run')->daily();
}
```

### Backups
```bash
# Configurar Laravel Backup
composer require spatie/laravel-backup

# Ejecutar backup
php artisan backup:run
```

## Troubleshooting

### Problemas Comunes

1. **Error de permisos en storage**
   ```bash
   chmod -R 755 storage
   chown -R www-data:www-data storage
   ```

2. **Cache corrupto**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

3. **Problemas con UUIDs**
   - Asegurar que la BD soporte CHAR(36)
   - Verificar configuración de HasUuids

4. **Errores de validación**
   - Revisar Form Requests
   - Verificar nombres de campos en vistas

### Logs de Errores
- Revisar `storage/logs/laravel.log`
- Configurar log levels en `.env`
- Usar servicios como Sentry para producción