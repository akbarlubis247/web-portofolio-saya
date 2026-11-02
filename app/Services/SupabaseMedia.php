<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class SupabaseMedia
{
    private const BUCKET = 'portfolio-media';

    public function upload(UploadedFile $file, string $directory): string
    {
        $this->ensureConfigured();

        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'bin');
        $path = trim($directory, '/').'/'.Str::uuid().'.'.$extension;
        $response = Http::withToken($this->serviceRoleKey())
            ->withHeaders([
                'apikey' => $this->serviceRoleKey(),
                'Content-Type' => $file->getMimeType() ?: 'application/octet-stream',
                'x-upsert' => 'false',
            ])
            ->withBody(file_get_contents($file->getRealPath()), $file->getMimeType() ?: 'application/octet-stream')
            ->post($this->apiUrl('/storage/v1/object/'.self::BUCKET.'/'.$path));

        if (! $response->successful()) {
            report(new RuntimeException('Supabase Storage upload failed: '.$response->body()));
            throw new RuntimeException('Gambar tidak dapat diunggah. Silakan coba lagi.');
        }

        return $this->publicUrl($path);
    }

    public function delete(?string $url): void
    {
        if (! $url || ! $this->isManagedUrl($url) || ! $this->isConfigured()) {
            return;
        }

        $path = Str::after($url, '/storage/v1/object/public/'.self::BUCKET.'/');
        Http::withToken($this->serviceRoleKey())
            ->withHeaders(['apikey' => $this->serviceRoleKey()])
            ->delete($this->apiUrl('/storage/v1/object/'.self::BUCKET.'/'.$path));
    }

    public function isManagedUrl(?string $url): bool
    {
        return is_string($url)
            && str_starts_with($url, rtrim((string) config('services.supabase.url'), '/').'/storage/v1/object/public/'.self::BUCKET.'/');
    }

    private function publicUrl(string $path): string
    {
        return rtrim((string) config('services.supabase.url'), '/')
            .'/storage/v1/object/public/'.self::BUCKET.'/'.$path;
    }

    private function apiUrl(string $path): string
    {
        return rtrim((string) config('services.supabase.url'), '/').$path;
    }

    private function isConfigured(): bool
    {
        return filled(config('services.supabase.url')) && filled(config('services.supabase.service_role_key'));
    }

    private function ensureConfigured(): void
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Penyimpanan gambar belum dikonfigurasi. Hubungi administrator.');
        }
    }

    private function serviceRoleKey(): string
    {
        return (string) config('services.supabase.service_role_key');
    }
}
