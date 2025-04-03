<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class EmailStorageService
{
    protected string $storagePath = 'emails';

    /**
     * Получить все сохраненные письма
     */
    public function getAllEmails(): array
    {
        $files = Storage::files($this->storagePath);
        $emails = [];

        foreach ($files as $file) {
            $emails[] = $this->getEmailData($file);
        }

        return $emails;
    }

    /**
     * Получить данные конкретного письма
     */
    public function getEmailData(string $filePath): array
    {
        return [
            'file' => $filePath,
            'content' => Storage::get($filePath),
            // 'created_at' => Storage::lastModified($filePath)
        ];
    }

    /**
     * Сохранить новое письмо
     */
    public function saveEmail(string $content): string
    {
        $filename = $this->storagePath.'/email_'.now()->format('Y-m-d_His').'.html';
        Storage::put($filename, $content);
        return $filename;
    }
}