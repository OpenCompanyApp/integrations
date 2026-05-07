<?php

namespace OpenCompany\Integrations\Wise;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Wise (TransferWise) API HTTP client.
 *
 * Handles Bearer token authentication and provides methods for interacting
 * with the Wise API including profiles, balances, transfers, and user info.
 */
class WiseService
{
    /**
     * Create a new WiseService instance.
     *
     * @param string $apiKey  Wise API token.
     * @param string $baseUrl Wise API base URL (default: https://api.wise.com).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.wise.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all profiles belonging to the authenticated user.
     *
     * @return array
     */
    public function listProfiles(): array
    {
        return $this->request('GET', '/v1/profiles');
    }

    /**
     * Get a single profile by ID.
     *
     * @param int|string $id Profile ID.
     * @return array
     */
    public function getProfile(int|string $id): array
    {
        return $this->request('GET', '/v1/profiles/' . $id);
    }

    /**
     * List multi-currency account balances for a given profile.
     *
     * @param int|string $profileId Profile ID.
     * @param  string  $types  Comma-separated balance types, for example STANDARD,SAVINGS.
     * @return array
     */
    public function listBalances(int|string $profileId, string $types = 'STANDARD,SAVINGS'): array
    {
        return $this->request('GET', '/v4/profiles/' . rawurlencode((string) $profileId) . '/balances', [
            'types' => $types,
        ]);
    }

    /**
     * List transfers with optional filtering.
     *
     * @param array $params Query parameters (limit, offset, profileId, status).
     * @return array
     */
    public function listTransfers(array $params = []): array
    {
        return $this->request('GET', '/v1/transfers', $params);
    }

    /**
     * Get a single transfer by ID.
     *
     * @param int|string $id Transfer ID.
     * @return array
     */
    public function getTransfer(int|string $id): array
    {
        return $this->request('GET', '/v1/transfers/' . $id);
    }

    /**
     * Create a new transfer.
     *
     * @param array $data Transfer creation payload.
     * @return array
     */
    public function createTransfer(array $data): array
    {
        return $this->request('POST', '/v1/transfers', $data);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   API path (e.g. /v1/profiles).
     * @param array  $data   Query parameters or request body.
     * @return array
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Wise API.
     *
     * @param string $method HTTP method.
     * @param string $path   API path.
     * @param array  $data   Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Wise API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                $error = $response->json('errors.0.message')
                    ?? $response->json('message')
                    ?? $response->body();

                Log::error("Wise API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Wise API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Wise API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Wise API: {$e->getMessage()}");
        }
    }
}
