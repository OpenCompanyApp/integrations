<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Pipedrive CRM API service.
 *
 * Handles HTTP communication with the Pipedrive API using Bearer token
 * authentication. Provides methods for deals, persons, organizations,
 * and user management.
 *
 * @see https://developers.pipedrive.com/docs/api/v1/
 */
class PipedriveService
{
    /**
     * Create a new PipedriveService instance.
     *
     * @param  string  $apiToken  Pipedrive API token used as Bearer token.
     * @param  string  $baseUrl  Base URL for the Pipedrive API (defaults to https://api.pipedrive.com/v1).
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.pipedrive.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ─── Deals ────────────────────────────────────────────────────────────

    /**
     * List deals with optional filtering and pagination.
     *
     * @param  int|null  $userId  Filter deals by user ID (assigned to).
     * @param  int|null  $personId  Filter deals by person ID.
     * @param  int|null  $orgId  Filter deals by organization ID.
     * @param  string|null  $status  Filter by status: "open", "won", "lost", "deleted".
     * @param  int  $limit  Maximum number of deals to return (default 25, max 500).
     * @param  int  $start  Pagination start (0-based offset).
     * @return array<string, mixed> API response containing deals and pagination info.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Deals#getDeals
     */
    public function listDeals(
        ?int $userId = null,
        ?int $personId = null,
        ?int $orgId = null,
        ?string $status = null,
        int $limit = 25,
        int $start = 0,
    ): array {
        $params = [
            'limit' => min($limit, 500),
            'start' => $start,
        ];
        if ($userId !== null) {
            $params['user_id'] = $userId;
        }
        if ($personId !== null) {
            $params['person_id'] = $personId;
        }
        if ($orgId !== null) {
            $params['org_id'] = $orgId;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/deals', $params);
    }

    /**
     * Get a single deal by ID.
     *
     * @param  int  $id  The deal ID.
     * @return array<string, mixed> The deal data.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Deals#getDeal
     */
    public function getDeal(int $id): array
    {
        return $this->request('GET', '/deals/' . $id);
    }

    /**
     * Create a new deal.
     *
     * @param  string  $title  The deal title.
     * @param  array<string, mixed>  $extra  Additional deal fields (value, currency, person_id, org_id, stage_id, etc.).
     * @return array<string, mixed> The created deal data.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Deals#addDeal
     */
    public function createDeal(string $title, array $extra = []): array
    {
        $data = array_merge(['title' => $title], $extra);

        return $this->request('POST', '/deals', $data);
    }

    // ─── Persons ──────────────────────────────────────────────────────────

    /**
     * List persons with optional filtering and pagination.
     *
     * @param  int  $limit  Maximum number of persons to return (default 25, max 500).
     * @param  int  $start  Pagination start (0-based offset).
     * @return array<string, mixed> API response containing persons and pagination info.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Persons#getPersons
     */
    public function listPersons(int $limit = 25, int $start = 0): array
    {
        return $this->request('GET', '/persons', [
            'limit' => min($limit, 500),
            'start' => $start,
        ]);
    }

    /**
     * Get a single person by ID.
     *
     * @param  int  $id  The person ID.
     * @return array<string, mixed> The person data.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Persons#getPerson
     */
    public function getPerson(int $id): array
    {
        return $this->request('GET', '/persons/' . $id);
    }

    // ─── Organizations ────────────────────────────────────────────────────

    /**
     * List organizations with optional filtering and pagination.
     *
     * @param  int  $limit  Maximum number of organizations to return (default 25, max 500).
     * @param  int  $start  Pagination start (0-based offset).
     * @return array<string, mixed> API response containing organizations and pagination info.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Organizations#getOrganizations
     */
    public function listOrganizations(int $limit = 25, int $start = 0): array
    {
        return $this->request('GET', '/organizations', [
            'limit' => min($limit, 500),
            'start' => $start,
        ]);
    }

    // ─── User ─────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The user profile data.
     *
     * @see https://developers.pipedrive.com/docs/api/v1/Users#getCurrentUser
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ─── Internal helpers ─────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/deals").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On API errors or connection failures.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Pipedrive API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Pipedrive API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Pipedrive API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $errors = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("Pipedrive API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $errors,
                ]);
                throw new \RuntimeException("Pipedrive API error ({$response->status()}): " . (is_string($errors) ? $errors : json_encode($errors)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pipedrive API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pipedrive API: {$e->getMessage()}");
        }
    }
}
