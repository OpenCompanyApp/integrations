<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Pipedrive REST API covering persons, organizations, deals, notes, pipelines, and stages.
 *
 * Wraps HTTP calls to Pipedrive's v1 API endpoints with API token authentication
 * appended as a query parameter on every request.
 */
class PipedriveService
{
    /**
     * @param  string  $apiToken       Pipedrive API token
     * @param  string  $companyDomain  Company domain (e.g. https://company.pipedrive.com)
     */
    public function __construct(
        private string $apiToken = '',
        private string $companyDomain = 'https://company.pipedrive.com',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Persons ─────────────────────────────────────────────

    /**
     * Create a person.
     *
     * @param  array<string, mixed>  $data  Person fields (name, email, phone, org_id)
     * @return array<string, mixed>
     */
    public function createPerson(array $data): array
    {
        return $this->request('POST', '/persons', $data);
    }

    /**
     * Get a person by ID.
     *
     * @param  int|string  $id  Person ID
     * @return array<string, mixed>
     */
    public function getPerson(int|string $id): array
    {
        return $this->request('GET', "/persons/{$id}");
    }

    /**
     * Update a person.
     *
     * @param  int|string              $id   Person ID
     * @param  array<string, mixed>    $data Fields to update (name, email, phone)
     * @return array<string, mixed>
     */
    public function updatePerson(int|string $id, array $data): array
    {
        return $this->request('PUT', "/persons/{$id}", $data);
    }

    /**
     * Search persons by term.
     *
     * @param  array<string, mixed>  $params  Search params (term, limit)
     * @return array<string, mixed>
     */
    public function searchPersons(array $params): array
    {
        return $this->request('GET', '/persons/search', $params);
    }

    // ── Organizations ───────────────────────────────────────

    /**
     * Create an organization.
     *
     * @param  array<string, mixed>  $data  Organization fields (name, address, owner_id)
     * @return array<string, mixed>
     */
    public function createOrganization(array $data): array
    {
        return $this->request('POST', '/organizations', $data);
    }

    /**
     * Get an organization by ID.
     *
     * @param  int|string  $id  Organization ID
     * @return array<string, mixed>
     */
    public function getOrganization(int|string $id): array
    {
        return $this->request('GET', "/organizations/{$id}");
    }

    /**
     * Update an organization.
     *
     * @param  int|string              $id   Organization ID
     * @param  array<string, mixed>    $data Fields to update (name, address)
     * @return array<string, mixed>
     */
    public function updateOrganization(int|string $id, array $data): array
    {
        return $this->request('PUT', "/organizations/{$id}", $data);
    }

    /**
     * Search organizations by term.
     *
     * @param  array<string, mixed>  $params  Search params (term, limit)
     * @return array<string, mixed>
     */
    public function searchOrganizations(array $params): array
    {
        return $this->request('GET', '/organizations/search', $params);
    }

    // ── Deals ───────────────────────────────────────────────

    /**
     * Create a deal.
     *
     * @param  array<string, mixed>  $data  Deal fields (title, value, currency, person_id, org_id, pipeline_id, stage_id)
     * @return array<string, mixed>
     */
    public function createDeal(array $data): array
    {
        return $this->request('POST', '/deals', $data);
    }

    /**
     * Get a deal by ID.
     *
     * @param  int|string  $id  Deal ID
     * @return array<string, mixed>
     */
    public function getDeal(int|string $id): array
    {
        return $this->request('GET', "/deals/{$id}");
    }

    /**
     * Update a deal.
     *
     * @param  int|string              $id   Deal ID
     * @param  array<string, mixed>    $data Fields to update (title, value, stage_id, status)
     * @return array<string, mixed>
     */
    public function updateDeal(int|string $id, array $data): array
    {
        return $this->request('PUT', "/deals/{$id}", $data);
    }

    /**
     * List deals with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (status, start, limit)
     * @return array<string, mixed>
     */
    public function listDeals(array $params = []): array
    {
        return $this->request('GET', '/deals', $params);
    }

    // ── Notes ───────────────────────────────────────────────

    /**
     * Create a note.
     *
     * @param  array<string, mixed>  $data  Note fields (content, deal_id, person_id, org_id)
     * @return array<string, mixed>
     */
    public function createNote(array $data): array
    {
        return $this->request('POST', '/notes', $data);
    }

    // ── Pipelines ───────────────────────────────────────────

    /**
     * List all pipelines.
     *
     * @return array<string, mixed>
     */
    public function listPipelines(): array
    {
        return $this->request('GET', '/pipelines');
    }

    // ── Stages ──────────────────────────────────────────────

    /**
     * List stages, optionally filtered by pipeline.
     *
     * @param  array<string, mixed>  $params  Query params (pipeline_id)
     * @return array<string, mixed>
     */
    public function listStages(array $params = []): array
    {
        return $this->request('GET', '/stages', $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Pipedrive.
     *
     * Appends api_token as a query parameter on every request.
     *
     * @param  string                 $method HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path   API path (e.g. /persons, /deals/123)
     * @param  array<string, mixed>  $data   Query params (GET) or JSON body (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Pipedrive API token is not configured.');
        }

        $baseUrl = rtrim($this->companyDomain, '/');
        $separator = str_contains($path, '?') ? '&' : '?';
        $url = $baseUrl . '/api/v1' . $path . $separator . 'api_token=' . urlencode($this->apiToken);

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Pipedrive API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Pipedrive API error ({$response->status()}): {$response->body()}");
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
