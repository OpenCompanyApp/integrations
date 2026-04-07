<?php

namespace OpenCompany\Integrations\Caddy;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CaddyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.caddyserver.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    public function listSites(array $params = []): array
    {
        return $this->request('GET', '/sites', $params);
    }

    public function getSite(string $siteId): array
    {
        return $this->request('GET', '/sites/' . urlencode($siteId));
    }

    public function createSite(array $data): array
    {
        return $this->request('POST', '/sites', $data);
    }

    public function deleteSite(string $siteId): array
    {
        return $this->request('DELETE', '/sites/' . urlencode($siteId));
    }

    public function listCertificates(array $params = []): array
    {
        return $this->request('GET', '/certificates', $params);
    }

    public function getCertificate(string $certificateId): array
    {
        return $this->request('GET', '/certificates/' . urlencode($certificateId));
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (!is_array($json)) {
            return [];
        }

        return $json;
    }

    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Caddy API access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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
                    Log::warning("Caddy API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Caddy API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $json = $response->json();
                $errors = $json['errors'] ?? [];
                $errorMessages = array_map(fn (array $e) => ($e['code'] ?? 0) . ': ' . ($e['message'] ?? 'Unknown error'), $errors);
                $error = !empty($errorMessages) ? implode('; ', $errorMessages) : $body;

                Log::error("Caddy API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Caddy API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Caddy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Caddy API: {$e->getMessage()}");
        }
    }
}
