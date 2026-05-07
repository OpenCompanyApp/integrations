<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the TrustMRR API.
 *
 * Handles bearer-token authentication, rate-limit errors, and JSON response parsing
 * for the documented startup listing and startup detail endpoints.
 */
class TrustMrrService
{
    /**
     * @param  string  $apiKey  TrustMRR API key.
     * @param  string  $baseUrl  Base URL for the TrustMRR API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://trustmrr.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether API credentials are available.
     */
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
     * @param  string  $slug  Startup slug from the list endpoint.
     * @return array<string, mixed>
     */
    public function getStartup(string $slug): array
    {
        return $this->request('GET', '/startups/' . rawurlencode($slug));
    }

    /**
     * Make an authenticated API request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path relative to the base URL.
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

            $url = $this->baseUrl . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                $reset = $response->header('X-RateLimit-Reset');
                $msg = 'TrustMRR rate limit exceeded (20 requests/minute).';
                if ($reset) {
                    $msg .= " Resets at: {$reset}";
                }
                throw new RuntimeException($msg);
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error'] ?? $response->body();

                Log::error("TrustMRR API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException(
                    'TrustMRR API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error("TrustMRR API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to TrustMRR API: {$e->getMessage()}");
        }
    }
}
