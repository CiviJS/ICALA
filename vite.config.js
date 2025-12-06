import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/home/index.css',
        'resources/css/planilla/planilla.css',
        'resources/css/planilla/verPlanilla.css',
        'resources/css/reportes/reportes.css',
        'resources/css/usuarios/crearUsuario.css',
        'resources/css/usuarios/editarUsuario.css',
        'resources/js/app.js',
     'resources/js/bootstrap.js',
      ],
      refresh: true,
    }),
            tailwindcss(),
  ],
});
