<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    // Ruta para listar los respaldos disponibles
    public function index()
    {
        $files = Storage::disk('local')->files('backups'); // Carpeta donde guardas los respaldos
        $backups = collect($files)->map(function ($file) {
            return (object) [
                'path' => $file,
                'size' => Storage::disk('local')->size($file),
            ];
        });

        return view('backup_restore.index', compact('backups'));
    }

    // Función para generar un respaldo
    public function backupDatabase(Request $request)
    {
        try {
            // Generar el nombre del archivo y la ruta de almacenamiento
            $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
            $filePath = storage_path("app/backups/$filename");
    
            // Comando para generar el respaldo
            $command = sprintf(
                'mysqldump --user=%s %s --host=%s %s > %s',
                escapeshellarg(env('DB_USERNAME')), // Usuario
                escapeshellarg(env('DB_PASSWORD') ?: ''), // Contraseña explícita, aunque esté vacía
                escapeshellarg(env('DB_HOST')), // Host
                escapeshellarg(env('DB_DATABASE')), // Base de datos
                escapeshellarg($filePath) // Ruta del archivo
            );
    
            // Ejecutar el comando
            exec($command, $output, $returnVar);
    
            // Verificar si hubo errores
            if ($returnVar !== 0) {
                return redirect()->route('backup_restore.index')->with('error', 'Error al generar el respaldo.');
            }
    
            // Descargar el archivo al navegador
            return response()->download($filePath)->deleteFileAfterSend(true);
    
        } catch (\Exception $e) {
            return redirect()->route('backup_restore.index')->with('error', 'Error al generar el respaldo: ' . $e->getMessage());
        }
    }
    

    // Función para restaurar un respaldo
    public function restoreDatabase(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file',
        ]);

        try {
            $file = $request->file('backup_file');
            $filePath = $file->storeAs('backups', $file->getClientOriginalName());

            $fullPath = storage_path('app/' . $filePath);

            // Comando para restaurar el respaldo
            $command = sprintf(
                'mysql --user=%s --password=%s --host=%s %s < %s',
                env('DB_USERNAME'),
                env('DB_PASSWORD'),
                env('DB_HOST'),
                env('DB_DATABASE'),
                $fullPath
            );

            // Ejecutar el comando
            exec($command);

            return redirect()->route('backup_restore.index')->with('success', 'Respaldo restaurado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('backup_restore.index')->with('error', 'Error al restaurar el respaldo: ' . $e->getMessage());
        }
    }
}