<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrustMrrService
{
    private const BASE_URL = 'https://trustmrr.com/api/v1';

    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * List startups with optional filters, sorting, and pagination.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listStartups(array $params = []): array
    {
        return $this->request('GET', '/startups', $params);
    }

    /**
     * Get full details for a single startup by slug.
     *
     * @return array<string, mixed>
     */
    public function getStartup(string $slug): array
    {
        return $this->request('GET', "/startups/{$slug}");
    }

    /**
     * Make an authenticated API request.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('TrustMRR API key is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Accept' => 'application/json',
            ])->timeout(15);

            $url = self::BASE_URL . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                $reset = $response->header('X-RateLimit-Reset');
                $msg = 'TrustMRR rate limit exceeded (20 requests/minute).';
                if ($reset) {
                    $msg .= " Resets at: {$reset}";
                }
                throw new \RuntimeException($msg);
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error'] ?? $response->body();

                Log::error("TrustMRR API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'TrustMRR API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("TrustMRR API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to TrustMRR API: {$e->getMessage()}");
        }
    }
}
