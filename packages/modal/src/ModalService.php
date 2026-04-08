<?php

namespace OpenCompany\Integrations\Modal;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Modal REST API covering apps, functions, schedules, volumes, and secrets.
 *
 * All operations are performed via REST against the Modal API. Handles
 * authentication, error reporting, and rate-limit awareness.
 */
class ModalService
{
    private const DEFAULT_BASE_URL = 'https://api.modal.com/v1';

    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Apps ───────────────────────────────────────────────

    /**
     * List all apps.
     *
     * @return array<string, mixed>
     */
    public function listApps(): array
    {
        return $this->request('GET', '/apps');
    }

    /**
     * Get a single app by ID.
     *
     * @return array<string, mixed>
     */
    public function getApp(string $appId): array
    {
        return $this->request('GET', '/apps/' . urlencode($appId));
    }

    // ── Functions ──────────────────────────────────────────

    /**
     * List functions for an app.
     *
     * @return array<string, mixed>
     */
    public function listFunctions(string $appId): array
    {
        return $this->request('GET', '/apps/' . urlencode($appId) . '/functions');
    }

    // ── Schedules ──────────────────────────────────────────

    /**
     * List schedules for an app.
     *
     * @return array<string, mixed>
     */
    public function listSchedules(string $appId): array
    {
        return $this->request('GET', '/apps/' . urlencode($appId) . '/schedules');
    }

    // ── Volumes ────────────────────────────────────────────

    /**
     * List all volumes.
     *
     * @return array<string, mixed>
     */
    public function listVolumes(): array
    {
        return $this->request('GET', '/volumes');
    }

    // ── Secrets ────────────────────────────────────────────

    /**
     * List all secrets.
     *
     * @return array<string, mixed>
     */
    public function listSecrets(): array
    {
        return $this->request('GET', '/secrets');
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Connection Test ────────────────────────────────────

    /**
     * Test the connection by fetching the current user.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $result = $this->getCurrentUser();
            $name = $result['name'] ?? $result['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Modal as \"{$name}\".",
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    // ── HTTP Transport ─────────────────────────────────────

    /**
     * Execute an HTTP request against the Modal API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (e.g. /apps)
     * @param  array<string, mixed>  $data  Query params or request body
     * @return array<string, mixed>  Parsed response data
     *
     * @throws \RuntimeException  On API errors or connection failure
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE') {
            return [];
        }

        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Modal API key is not configured.');
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

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Modal API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Modal API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Modal API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Modal API: {$e->getMessage()}");
        }
    }
}
