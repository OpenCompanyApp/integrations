<?php

namespace OpenCompany\Integrations\Recruitee;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecruiteeService
{
    /**
     * Create a new Recruitee service instance.
     *
     * @param  string  $accessToken  Recruitee API bearer token
     * @param  string  $companyId    Recruitee company ID
     * @param  string  $baseUrl      Base URL for the Recruitee API (default: https://{company}.recruitee.com/api/v2)
     */
    public function __construct(
        private string $accessToken = '',
        private string $companyId = '',
        private string $baseUrl = 'https://{company}.recruitee.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->companyId);
    }

    /**
     * Get the configured company ID.
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * List job offers.
     *
     * @param  array  $params  Query parameters (e.g., status, page, limit)
     * @return array<string, mixed>
     */
    public function listOffers(array $params = []): array
    {
        return $this->request('GET', '/offers', $params);
    }

    /**
     * Get a single job offer by ID.
     *
     * @param  int  $offerId  The offer ID
     * @return array<string, mixed>
     */
    public function getOffer(int $offerId): array
    {
        return $this->request('GET', '/offers/' . $offerId);
    }

    /**
     * List candidates.
     *
     * @param  array  $params  Query parameters (e.g., page, limit)
     * @return array<string, mixed>
     */
    public function listCandidates(array $params = []): array
    {
        return $this->request('GET', '/candidates', $params);
    }

    /**
     * Get a single candidate by ID.
     *
     * @param  int  $candidateId  The candidate ID
     * @return array<string, mixed>
     */
    public function getCandidate(int $candidateId): array
    {
        return $this->request('GET', '/candidates/' . $candidateId);
    }

    /**
     * List all departments.
     *
     * @return array<string, mixed>
     */
    public function listDepartments(): array
    {
        return $this->request('GET', '/departments');
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g., /offers)
     * @param  array  $data    Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Recruitee API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g., /offers)
     * @param  array  $data    Query or body parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Recruitee access token is not configured.');
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
                    Log::warning("Recruitee API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Recruitee API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Recruitee API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Recruitee API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Recruitee API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Recruitee API: {$e->getMessage()}");
        }
    }
}
