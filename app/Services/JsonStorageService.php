<?php

namespace App\Services;

class JsonStorageService
{
    protected $filePath;

    public function __construct($filePath = 'data.txt')
    {
        $this->filePath = storage_path("app/{$filePath}");
    }

    public function get($key = null)
    {
        if (!file_exists($this->filePath)) {
            return $key ? null : [];
        }

        $json = file_get_contents($this->filePath);
        $data = json_decode($json, true) ?? [];

        return $key === null ? $data : ($data[$key] ?? null);
    }

    public function set($key, $value)
    {
        $data = $this->get();
        $data[$key] = $value;
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
