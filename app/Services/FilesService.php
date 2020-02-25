<?php

namespace App\Services;

use App\Models\Files;

class FilesService
{
    /**
     * Create new device job
     *
     **/
    public function create(array $fields, object $file): array
    {
        return $this->store($fields, $file);
    }
    
    private function store(array $fields, object $file): array
    {
        $path = 'public/' . $fields['device_id'] . '/camera/';
        $file->store($path);

        $files = new Files;
        $files->device_id = $fields['device_id'];
        $files->type = $fields['type'];
        $files->file = $path . $fields['filename'];
        $files->checksum = $fields['checksum'];
        $files->status = $fields['status'];
        if ($files->save()) {
            (new LogsService)->handle('filesLogs.create', 'Created file (' . $files->file_id . ')');
            return ['status' => 'success', 'message' => 'File has been successfully created'];
        }
        (new LogsService)->handle('filesLogs.create.error', 'Failed creating file (' . $fields['filename'] . ')');
        return ['status' => 'error', 'message' => 'Something went wrong with saving'];
    }
}