# Documentación del Proyecto - Gestión de Integrantes ICALA

## Índice

### 📋 [README.md](../README.md)
Documentación principal del proyecto con descripción general, instalación y uso básico.

### 🔌 [API Endpoints](api.md)
Documentación completa de todos los endpoints de la aplicación, incluyendo:
- Rutas públicas y protegidas
- Parámetros y respuestas
- Servicios y métodos
- Validaciones y middleware

### 🗄️ [Base de Datos](database.md)
Esquema completo de la base de datos, incluyendo:
- Estructura de tablas
- Relaciones entre entidades
- Migraciones
- Consultas comunes
- Configuración de conexión

### 💻 [Guía de Desarrollo](development.md)
Guía técnica para desarrolladores, incluyendo:
- Arquitectura de la aplicación
- Convenciones de código
- Configuración de desarrollo
- Testing
- Despliegue
- Debugging y mantenimiento

## 📂 Estructura del Proyecto

```
Iglesia/
├── 📁 app/                    # Código de la aplicación
│   ├── 📁 Http/Controllers/   # Controladores web
│   ├── 📁 Models/            # Modelos Eloquent
│   ├── 📁 Services/          # Lógica de negocio
│   └── 📁 Observers/         # Observers de modelos
├── 📁 resources/views/       # Plantillas Blade
├── 📁 routes/web.php         # Definición de rutas
├── 📁 database/migrations/   # Migraciones de BD
├── 📁 docs/                  # 📖 Esta documentación
├── 📄 composer.json          # Dependencias PHP
├── 📄 package.json           # Dependencias Node.js
├── 📄 vite.config.js         # Configuración de Vite
└── 📄 README.md              # Documentación principal
```

## 🚀 Inicio Rápido

1. **Instalación**: Ver [README.md](../README.md#instalación-y-configuración)
2. **Base de Datos**: Consultar [database.md](database.md)
3. **Desarrollo**: Seguir [development.md](development.md)
4. **API**: Referenciar [api.md](api.md)

## 📞 Soporte

Para preguntas sobre el proyecto o contribuciones, consultar las secciones correspondientes en cada documento.

## 📝 Notas de Versión

### v1.0.0
- Sistema básico de gestión de integrantes
- CRUD de usuarios, planillas y eventos
- Sistema de reportes
- Autenticación de administradores
- Interfaz web responsive

### Funcionalidades Clave
- ✅ Gestión de usuarios/integrantes
- ✅ Planillas de asistencia
- ✅ Control de eventos
- ✅ Reportes de asistencia y cumpleaños
- ✅ Autenticación y autorización
- ✅ Interfaz web moderna con Tailwind CSS

## 🤝 Contribución

Ver la guía de desarrollo para información sobre cómo contribuir al proyecto.