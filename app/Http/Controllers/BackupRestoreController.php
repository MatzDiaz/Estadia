<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BackupRestoreController extends Controller
{
    /**
     * Mostrar los respaldos disponibles.
     */
    public function index()
    {
        // Listar archivos de respaldo en el disco configurado
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $backups = collect($disk->allFiles(config('backup.backup.name')))
            ->filter(fn($file) => str_ends_with($file, '.zip'))
            ->sortDesc();

        return view('backup_restore.index', compact('backups'));
    }

    /**
     * Generar un respaldo.
     */
    public function backupDatabase()
    {
        try {
            // Ejecutar el comando de respaldo
            Artisan::call('backup:run');

            return back()->with('success', 'Respaldo generado exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el respaldo: ' . $e->getMessage());
        }
    }

    /**
     * Restaurar un respaldo.
     */
    public function restoreDatabase(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:zip',
        ]);

        $filePath = $request->file('backup_file')->storeAs(
            config('backup.backup.name'),
            $request->file('backup_file')->getClientOriginalName(),
            config('backup.backup.destination.disks')[0]
        );

        // Proceso de restauración (personalizado según tu implementación)
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $backupPath = $disk->path($filePath);

            // Restaurar la base de datos desde el archivo
            $command = sprintf(
                'mysql -u%s -p%s -h%s %s < %s',
                escapeshellarg(env('DB_USERNAME')),
                escapeshellarg(env('DB_PASSWORD')),
                escapeshellarg(env('DB_HOST')),
                escapeshellarg(env('DB_DATABASE')),
                escapeshellarg($backupPath)
            );

            system($command, $output);

            if ($output === 0) {
                return back()->with('success', 'Base de datos restaurada exitosamente.');
            } else {
                throw new \Exception('El proceso de restauración falló.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al restaurar la base de datos: ' . $e->getMessage());
        }
    }
}
