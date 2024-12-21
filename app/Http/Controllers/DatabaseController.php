<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseController extends Controller
{
    // Ruta para listar los respaldos disponibles
    public function index()
    {
        // Obtiene la lista de archivos almacenados en la carpeta 'backups'
        $files = Storage::disk('local')->files('backups');
        
        // Mapea los archivos para incluir la ruta y el tamaño en bytes
        $backups = collect($files)->map(function ($file) {
            return (object) [
                'path' => $file,
                'size' => Storage::disk('local')->size($file),
            ];
        });

        // Retorna la vista con la lista de respaldos disponibles
        return view('backup_restore.index', compact('backups'));
    }

    // Función para generar un respaldo de la base de datos
    public function backupDatabase(Request $request)
    {
        if(function_exists('shell_exec')) { // Verifica si la función shell_exec está disponible
            // Define el nombre del archivo de respaldo con fecha y hora actual
            $fechaHora = date('d-m-Y_H-i-s');
            $archivoTemporal = 'backup_' . $fechaHora . '.sql';

            // Obtiene los valores necesarios del archivo .env
            $databaseHost = env('DB_HOST');
            $databaseUsername = env('DB_USERNAME');
            $databaseName = env('DB_DATABASE');

            // Construye el comando mysqldump para crear el respaldo
            $comando = "C:/xampp/mysql/bin/mysqldump -h $databaseHost -u $databaseUsername $databaseName > $archivoTemporal";
            
            // Ejecuta el comando en el sistema
            shell_exec($comando);

            // Obtiene el contenido del archivo de respaldo
            $contenido = file_get_contents($archivoTemporal);

            // Prepara la respuesta para descargar el archivo
            $response = response($contenido, 200);
            $response->header('Content-Type', 'application/octet-stream');
            $response->header('Content-Disposition', 'attachment; filename=' . $archivoTemporal);

            // Elimina el archivo temporal después de la descarga
            unlink($archivoTemporal);

            return $response;
        }
    }

    // Función para restaurar la base de datos desde un archivo SQL
    public function restoreDatabase(Request $request)
    {
        // Valida que el archivo sea requerido, que sea un archivo válido y de tipo SQL
        $request->validate([
            'backup_file' => 'required|file|mimetypes:text/plain',
        ], [
            'backup_file.required' => 'El archivo es requerido',
            'backup_file.file' => 'El archivo debe ser un archivo',
            'backup_file.mimetypes' => 'El archivo debe ser de tipo SQL',
        ]);

        // Obtiene el archivo cargado
        $archivo = $request->file('backup_file');

        // Valida que el archivo tenga la extensión correcta
        $extension = $archivo->getClientOriginalExtension();
        if ($extension !== 'sql') {
            return redirect()->back()->withErrors(['error' => 'El archivo debe ser de tipo SQL.']);
        }

        if ($request->hasFile('backup_file')) {
            // Almacena el archivo temporalmente en el almacenamiento local
            $archivo = $request->file('backup_file')->storeAs('temp', 'import.sql');
            $sqlPath = storage_path('app/' . $archivo);

            // Lee el contenido del archivo SQL
            $sqlContent = file_get_contents($sqlPath);
            if ($sqlContent === false) {
                return redirect()->back()->with('error', 'No se pudo leer el archivo SQL.');
            }

            // Intenta ejecutar las sentencias SQL
            try {
                DB::unprepared($sqlContent);
                return redirect()->back()->with('success', 'Base de datos restaurada correctamente.');
            } catch (\Exception $e) {
                // Registra el error en el log del sistema
                Log::error('Error al restaurar la base de datos: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error al restaurar la base de datos: ' . $e->getMessage());
            }
        } else {
            // Devuelve un error si no se proporcionó ningún archivo
            return redirect()->back()->withErrors(['error' => 'No se ha proporcionado ningún archivo para la restauración.']);
        }
    }

}
