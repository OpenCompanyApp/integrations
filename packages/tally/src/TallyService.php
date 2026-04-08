<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Tally API service client for form and submission management.
 *
 * Wraps all HTTP communication with the Tally REST API.
 * Tools call this service — they never make HTTP requests directly.
 */
class TallyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.tally.so',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // ── Forms ─────────────────────────────────────────────

    /**
     * List forms with optional pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listForms(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/forms', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single form by ID.
     *
     * @param  string  $formId  The Tally form ID.
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId));
    }

    // ── Submissions ───────────────────────────────────────

    /**
     * List submissions for a specific form with optional pagination.
     *
     * @param  string  $formId  The Tally form ID.
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listSubmissions(string $formId, int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '/submissions', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single submission by ID.
     *
     * @param  string  $submissionId  The Tally submission ID.
     * @return array<string, mixed>
     */
    public function getSubmission(string $submissionId): array
    {
        return $this->request('GET', '/submissions/' . urlencode($submissionId));
    }

    // ── Workspaces ────────────────────────────────────────

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/workspaces');
    }

    // ── User ──────────────────────────────────────────────

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/forms").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException on connection or API errors.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Tally API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException on missing credentials, connection failure, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Tally access token is not configured.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Tally API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Tally API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Tally API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Tally API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Tally API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Tally API: {$e->getMessage()}");
        }
    }
}
