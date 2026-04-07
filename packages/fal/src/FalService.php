<?php

namespace OpenCompany\Integrations\Fal;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FalService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://queue.fal.run',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    public function submitRequest(string $modelId, array $input, ?string $webhookUrl = null): array
    {
        $path = '/' . ltrim($modelId, '/');
        $body = ['input' => $input];

        if ($webhookUrl !== null) {
            $body['webhook_url'] = $webhookUrl;
        }

        return $this->request('POST', $path . '/submit', $body);
    }

    public function getRequestStatus(string $modelId, string $requestId): array
    {
        $path = '/' . ltrim($modelId, '/');

        return $this->request('GET', $path . '/requests/' . urlencode($requestId) . '/status');
    }

    public function getResult(string $modelId, string $requestId): array
    {
        $path = '/' . ltrim($modelId, '/');

        return $this->request('GET', $path . '/requests/' . urlencode($requestId));
    }

    public function listFiles(): array
    {
        return $this->request('GET', '/files');
    }

    public function uploadFile(string $filePath, ?string $fileName = null): array
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('fal.ai API key is not configured.');
        }

        $fileName = $fileName ?? basename($filePath);

        $response = Http::withToken($this->apiKey)
            ->timeout(120)
            ->attach('file', file_get_contents($filePath), $fileName)
            ->post($this->baseUrl . '/files/upload');

        if (!$response->successful()) {
            $error = $response->json('detail') ?? $response->body();
            Log::error('fal.ai file upload error', [
                'status' => $response->status(),
                'error' => $error,
            ]);
            throw new \RuntimeException('fal.ai file upload error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
        }

        return $response->json() ?? [];
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('fal.ai API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(120);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("fal.ai API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("fal.ai API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $body;
                Log::error("fal.ai API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException('fal.ai API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("fal.ai API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to fal.ai API: ' . $e->getMessage());
        }
    }
}
