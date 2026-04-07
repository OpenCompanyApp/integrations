<?php

namespace OpenCompany\Integrations\Phrase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Phrase API covering projects, keys, translations, locales, and user info.
 *
 * Wraps the Phrase API v2 and handles Bearer authentication, request routing,
 * and error reporting.
 */
class PhraseService
{
    private string $baseUrl = 'https://api.phrase.com/v2';

    /**
     * @param  string  $accessToken  Phrase API token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    /**
     * Check whether the service has sufficient credentials to make API calls.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Projects ───────────────────────────────────────────

    /**
     * List all projects the authenticated user has access to.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. page, per_page)
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get a single project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        return $this->request('GET', "/projects/{$projectId}");
    }

    // ── Keys ───────────────────────────────────────────────

    /**
     * List keys in a project.
     *
     * @param  string  $projectId  The project ID
     * @param  array<string, mixed>  $params  Query parameters (e.g. page, per_page, q)
     * @return array<string, mixed>
     */
    public function listKeys(string $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/keys", $params);
    }

    /**
     * Get a single key by ID.
     *
     * @param  string  $projectId  The project ID
     * @param  string  $keyId  The key ID
     * @return array<string, mixed>
     */
    public function getKey(string $projectId, string $keyId): array
    {
        return $this->request('GET', "/projects/{$projectId}/keys/{$keyId}");
    }

    // ── Translations ───────────────────────────────────────

    /**
     * List translations in a project.
     *
     * @param  string  $projectId  The project ID
     * @param  array<string, mixed>  $params  Query parameters (e.g. page, per_page, key_id, locale_id)
     * @return array<string, mixed>
     */
    public function listTranslations(string $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/translations", $params);
    }

    // ── Locales ────────────────────────────────────────────

    /**
     * List locales in a project.
     *
     * @param  string  $projectId  The project ID
     * @param  array<string, mixed>  $params  Query parameters (e.g. page, per_page)
     * @return array<string, mixed>
     */
    public function listLocales(string $projectId, array $params = []): array
    {
        return $this->request('GET', "/projects/{$projectId}/locales", $params);
    }

    // ── User ───────────────────────────────────────────────

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Phrase API v2.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path relative to the base URL
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Phrase access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $url = $this->baseUrl . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['error'] ?? $response->body();

                Log::error("Phrase API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Phrase API error (' . $response->status() . '): ' . $msg);
            }

            // DELETE may return 204 No Content
            if ($response->status() === 204) {
                return ['deleted' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Phrase API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Phrase API: {$e->getMessage()}");
        }
    }
}
