<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class ModelToMigration extends Command
{
    protected $signature = 'make:migration-from-models';
    protected $description = 'Genera archivos de migración basados en los modelos existentes';

    public function handle()
    {
        //CODIGO GENERADO POR GEMINI XDDD ; REVISADO Y CORREGIDO POR MI 
        $modelFiles = File::files(app_path('Models'));

        foreach ($modelFiles as $file) {
            $modelName = $file->getFilenameWithoutExtension();
            $fullClassName = "App\\Models\\$modelName";

            if (!class_exists($fullClassName)) continue;

            $this->info("Procesando modelo: $modelName...");
            $this->generateMigration($fullClassName, $modelName);
        }

        $this->info('¡Proceso completado! Revisa tu carpeta de migrations.');
    }

    protected function generateMigration($fullClassName, $modelName)
    {
        $reflection = new ReflectionClass($fullClassName);
        $model = new $fullClassName;
        
        $tableName = $model->getTable();
        $fillable = $model->getFillable();
        $casts = $model->getCasts();
        $primaryKey = $model->getKeyName();
        $isUuid = method_exists($model, 'getIncrementing') && !$model->getIncrementing();

        $migrationName = "create_" . $tableName . "_table";
        $fileName = date('Y_m_d_His') . "_" . $migrationName . ".php";
        
        $columns = "";

        // Lógica de Llave Primaria
        if ($isUuid) {
            $columns .= "            \$table->uuid('$primaryKey')->primary();\n";
        } else {
            $columns .= "            \$table->id();\n";
        }

        // Lógica de Campos
        foreach ($fillable as $field) {
            if (isset($casts[$field]) && str_contains($casts[$field], 'date')) {
                $columns .= "            \$table->dateTime('$field');\n";
            } elseif (str_contains($field, '_id') || str_contains($field, 'encargado')) {
                $columns .= "            \$table->unsignedBigInteger('$field');\n";
            } else {
                $columns .= "            \$table->string('$field');\n";
            }
        }

        // Timestamps
        if ($model->timestamps) {
            $columns .= "            \$table->timestamps();\n";
        }

        $template = "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('$tableName', function (Blueprint \$table) {
$columns        });
    }

    public function down(): void {
        Schema::dropIfExists('$tableName');
    }
};";

        File::put(database_path("migrations/$fileName"), $template);
        $this->line(" Migración creada para $tableName");
    }
}