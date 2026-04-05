<?php

namespace OpenCompany\Integrations\Metabase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetabaseService
{
    private ?string $sessionToken = null;

    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $hostname = '',
    ) {
        $this->hostname = rtrim($this->hostname, '/');
    }

    /**
     * Check whether the service has enough credentials to attempt a connection.
     */
    public function isConfigured(): bool
    {
        return !empty($this->username) && !empty($this->password) && !empty($this->hostname);
    }

    /**
     * Authenticate with Metabase and store the session token.
     *
     * @throws \RuntimeException
     */
    public function authenticate(): void
    {
        $this->request('POST', '/api/session', [
            'username' => $this->username,
            'password' => $this->password,
        ]);
    }

    /**
     * Obtain a valid session token, authenticating if necessary.
     */
    private function getSessionToken(): string
    {
        if ($this->sessionToken !== null) {
            return $this->sessionToken;
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->timeout(30)->post($this->hostname . '/api/session', [
            'username' => $this->username,
            'password' => $this->password,
        ]);

        if (!$response->successful()) {
            Log::error('Metabase authentication failed', [
                'status' => $response->status(),
            ]);
            throw new \RuntimeException("Metabase authentication failed (HTTP {$response->status()}).");
        }

        $this->sessionToken = $response->json('id');

        if (empty($this->sessionToken)) {
            throw new \RuntimeException('Metabase authentication succeeded but no session token was returned.');
        }

        return $this->sessionToken;
    }

    /**
     * List all dashboards.
     *
     * @return array<int, array{id: int, name: string}>
     */
    public function listDashboards(): array
    {
        return $this->request('GET', '/api/dashboard');
    }

    /**
     * Get a single dashboard with its cards (questions).
     *
     * @return array<string, mixed>
     */
    public function getDashboard(int $id): array
    {
        return $this->request('GET', '/api/dashboard/' . $id);
    }

    /**
     * List all cards (questions).
     *
     * @return array<int, array{id: int, name: string}>
     */
    public function listCards(): array
    {
        return $this->request('GET', '/api/card');
    }

    /**
     * Get a single card (question) definition.
     *
     * @return array<string, mixed>
     */
    public function getCard(int $id): array
    {
        return $this->request('GET', '/api/card/' . $id);
    }

    /**
     * Execute a card (question) query and return the results.
     *
     * @return array<string, mixed>
     */
    public function queryCard(int $id): array
    {
        return $this->request('POST', '/api/card/' . $id . '/query');
    }

    /**
     * List all databases.
     *
     * @return array<int, array{id: int, name: string}>
     */
    public function listDatabases(): array
    {
        return $this->request('GET', '/api/database');
    }

    /**
     * Get a single database with its metadata (tables, fields).
     *
     * @return array<string, mixed>
     */
    public function getDatabase(int $id): array
    {
        return $this->request('GET', '/api/database/' . $id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/user/current');
    }

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Metabase integration is not configured. Provide hostname, username, and password.');
        }

        $url = $this->hostname . $path;

        try {
            $token = $this->getSessionToken();

            $http = Http::withHeaders([
                'X-Metabase-Session' => $token,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            // Session expired — re-authenticate once and retry
            if ($response->status() === 401 && $path !== '/api/session') {
                $this->sessionToken = null;
                $token = $this->getSessionToken();

                $http = Http::withHeaders([
                    'X-Metabase-Session' => $token,
                    'Content-Type' => 'application/json',
                ])->timeout(30);

                $response = match (strtoupper($method)) {
                    'GET' => $http->get($url, $data),
                    'POST' => $http->post($url, $data),
                    'PUT' => $http->put($url, $data),
                    'DELETE' => $http->delete($url, $data),
                    default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
                };
            }

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->body();
                Log::error("Metabase API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($error) ? $error : json_encode($error),
                ]);
                throw new \RuntimeException("Metabase API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Metabase API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Metabase API: {$e->getMessage()}");
        }
    }
}
