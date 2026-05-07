<?php

namespace OpenCompany\Integrations\Capsule;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Capsule CRM API v2.
 *
 * Handles bearer-token authentication, URL construction, error logging, and
 * response parsing for parties, opportunities, cases, tasks, tracks, tags, and fields.
 */
class CapsuleService
{
    /**
     * @param  string  $accessToken  Capsule CRM personal access token or OAuth access token.
     * @param  string  $baseUrl  Capsule CRM API v2 base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.capsulecrm.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /*
    |--------------------------------------------------------------------------
    | Parties
    |--------------------------------------------------------------------------
    */

    /**
     * List contacts and organisations.
     *
     * @param  int  $page  Page number.
     * @param  int  $perPage  Number of records per page.
     * @param  array<string, mixed>  $params  Additional query parameters such as q, since, and embed.
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 50, array $params = []): array
    {
        return $this->listParties(array_merge($params, [
            'page' => $page,
            'perPage' => $perPage,
        ]));
    }

    /**
     * List parties using native Capsule query parameters.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listParties(array $params = []): array
    {
        return $this->request('GET', '/parties', query: $params);
    }

    /**
     * Get one party.
     *
     * @param  int  $id  Party ID.
     * @param  array<string, mixed>  $params  Optional query parameters such as embed.
     * @return array<string, mixed>
     */
    public function getContact(int $id, array $params = []): array
    {
        return $this->request('GET', "/parties/{$id}", query: $params);
    }

    /**
     * Create a party using the legacy convenience signature.
     *
     * @param  string  $type  Party type.
     * @param  string  $firstName  First name for people.
     * @param  string  $lastName  Last name for people.
     * @param  array<int, array<string, mixed>>  $emailAddresses  Email address objects.
     * @return array<string, mixed>
     */
    public function createContact(string $type = 'person', string $firstName = '', string $lastName = '', array $emailAddresses = []): array
    {
        $party = ['type' => $type];

        if ($type === 'organisation') {
            $name = trim($firstName.' '.$lastName);
            if ($name !== '') {
                $party['name'] = $name;
            }
        } else {
            if ($firstName !== '') {
                $party['firstName'] = $firstName;
            }
            if ($lastName !== '') {
                $party['lastName'] = $lastName;
            }
        }

        if ($emailAddresses !== []) {
            $party['emailAddresses'] = $emailAddresses;
        }

        return $this->createParty($party);
    }

    /**
     * Create a party from a native Capsule party payload.
     *
     * @param  array<string, mixed>  $party  Party payload.
     * @return array<string, mixed>
     */
    public function createParty(array $party): array
    {
        return $this->request('POST', '/parties', body: ['party' => $party]);
    }

    /**
     * Update a party.
     *
     * @param  int  $id  Party ID.
     * @param  array<string, mixed>  $party  Party update payload.
     * @return array<string, mixed>
     */
    public function updateParty(int $id, array $party): array
    {
        return $this->request('PUT', "/parties/{$id}", body: ['party' => $party]);
    }

    /**
     * Delete a party.
     *
     * @param  int  $id  Party ID.
     * @return array<string, mixed>
     */
    public function deleteParty(int $id): array
    {
        return $this->request('DELETE', "/parties/{$id}");
    }

    /*
    |--------------------------------------------------------------------------
    | Opportunities
    |--------------------------------------------------------------------------
    */

    /**
     * List opportunities.
     *
     * @param  int  $page  Page number.
     * @param  int  $perPage  Number of records per page.
     * @param  string|null  $status  Optional status filter.
     * @param  array<string, mixed>  $params  Additional query parameters.
     * @return array<string, mixed>
     */
    public function listOpportunities(int $page = 1, int $perPage = 50, ?string $status = null, array $params = []): array
    {
        $params = array_merge($params, [
            'page' => $page,
            'perPage' => $perPage,
        ]);

        if ($status !== null && $status !== '') {
            $params['status'] = $status;
        }

        return $this->request('GET', '/opportunities', query: $params);
    }

    /**
     * List opportunities for a party.
     *
     * @param  int  $partyId  Party ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPartyOpportunities(int $partyId, array $params = []): array
    {
        return $this->request('GET', "/parties/{$partyId}/opportunities", query: $params);
    }

    /**
     * Get one opportunity.
     *
     * @param  int  $id  Opportunity ID.
     * @param  array<string, mixed>  $params  Optional query parameters such as embed.
     * @return array<string, mixed>
     */
    public function getOpportunity(int $id, array $params = []): array
    {
        return $this->request('GET', "/opportunities/{$id}", query: $params);
    }

    /**
     * Create an opportunity.
     *
     * @param  array<string, mixed>  $opportunity  Opportunity payload.
     * @return array<string, mixed>
     */
    public function createOpportunity(array $opportunity): array
    {
        return $this->request('POST', '/opportunities', body: ['opportunity' => $opportunity]);
    }

    /**
     * Update an opportunity.
     *
     * @param  int  $id  Opportunity ID.
     * @param  array<string, mixed>  $opportunity  Opportunity update payload.
     * @return array<string, mixed>
     */
    public function updateOpportunity(int $id, array $opportunity): array
    {
        return $this->request('PUT', "/opportunities/{$id}", body: ['opportunity' => $opportunity]);
    }

    /**
     * Delete an opportunity.
     *
     * @param  int  $id  Opportunity ID.
     * @return array<string, mixed>
     */
    public function deleteOpportunity(int $id): array
    {
        return $this->request('DELETE', "/opportunities/{$id}");
    }

    /*
    |--------------------------------------------------------------------------
    | Cases
    |--------------------------------------------------------------------------
    */

    /**
     * List projects/cases.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCases(array $params = []): array
    {
        return $this->request('GET', '/kases', query: $params);
    }

    /**
     * List projects/cases for a party.
     *
     * @param  int  $partyId  Party ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPartyCases(int $partyId, array $params = []): array
    {
        return $this->request('GET', "/parties/{$partyId}/kases", query: $params);
    }

    /**
     * Get one project/case.
     *
     * @param  int  $id  Case ID.
     * @param  array<string, mixed>  $params  Optional query parameters such as embed.
     * @return array<string, mixed>
     */
    public function getCase(int $id, array $params = []): array
    {
        return $this->request('GET', "/kases/{$id}", query: $params);
    }

    /**
     * Create a project/case.
     *
     * @param  array<string, mixed>  $kase  Case payload.
     * @return array<string, mixed>
     */
    public function createCase(array $kase): array
    {
        return $this->request('POST', '/kases', body: ['kase' => $kase]);
    }

    /**
     * Update a project/case.
     *
     * @param  int  $id  Case ID.
     * @param  array<string, mixed>  $kase  Case update payload.
     * @return array<string, mixed>
     */
    public function updateCase(int $id, array $kase): array
    {
        return $this->request('PUT', "/kases/{$id}", body: ['kase' => $kase]);
    }

    /**
     * Delete a project/case.
     *
     * @param  int  $id  Case ID.
     * @return array<string, mixed>
     */
    public function deleteCase(int $id): array
    {
        return $this->request('DELETE', "/kases/{$id}");
    }

    /*
    |--------------------------------------------------------------------------
    | Tasks
    |--------------------------------------------------------------------------
    */

    /**
     * List tasks.
     *
     * @param  int  $page  Page number.
     * @param  int  $perPage  Number of records per page.
     * @param  string|null  $status  Optional status filter.
     * @param  array<string, mixed>  $params  Additional query parameters.
     * @return array<string, mixed>
     */
    public function listTasks(int $page = 1, int $perPage = 50, ?string $status = null, array $params = []): array
    {
        $params = array_merge($params, [
            'page' => $page,
            'perPage' => $perPage,
        ]);

        if ($status !== null && $status !== '') {
            $params['status'] = $status;
        }

        return $this->request('GET', '/tasks', query: $params);
    }

    /**
     * Get one task.
     *
     * @param  int  $id  Task ID.
     * @return array<string, mixed>
     */
    public function getTask(int $id): array
    {
        return $this->request('GET', "/tasks/{$id}");
    }

    /**
     * Create a task.
     *
     * @param  array<string, mixed>  $task  Task payload.
     * @return array<string, mixed>
     */
    public function createTask(array $task): array
    {
        return $this->request('POST', '/tasks', body: ['task' => $task]);
    }

    /**
     * Update a task.
     *
     * @param  int  $id  Task ID.
     * @param  array<string, mixed>  $task  Task update payload.
     * @return array<string, mixed>
     */
    public function updateTask(int $id, array $task): array
    {
        return $this->request('PUT', "/tasks/{$id}", body: ['task' => $task]);
    }

    /**
     * Delete a task.
     *
     * @param  int  $id  Task ID.
     * @return array<string, mixed>
     */
    public function deleteTask(int $id): array
    {
        return $this->request('DELETE', "/tasks/{$id}");
    }

    /*
    |--------------------------------------------------------------------------
    | Tracks, tags, and fields
    |--------------------------------------------------------------------------
    */

    /**
     * List track definitions.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTracks(array $params = []): array
    {
        return $this->request('GET', '/tracks', query: $params);
    }

    /**
     * List tag definitions for parties, opportunities, or kases.
     *
     * @param  string  $entity  Entity path: parties, opportunities, or kases.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTags(string $entity, array $params = []): array
    {
        return $this->request('GET', '/'.$this->entity($entity).'/tags', query: $params);
    }

    /**
     * Create a tag definition.
     *
     * @param  string  $entity  Entity path.
     * @param  array<string, mixed>  $tag  Tag payload.
     * @return array<string, mixed>
     */
    public function createTag(string $entity, array $tag): array
    {
        return $this->request('POST', '/'.$this->entity($entity).'/tags', body: ['tag' => $tag]);
    }

    /**
     * Update a tag definition.
     *
     * @param  string  $entity  Entity path.
     * @param  int  $tagId  Tag ID.
     * @param  array<string, mixed>  $tag  Tag update payload.
     * @return array<string, mixed>
     */
    public function updateTag(string $entity, int $tagId, array $tag): array
    {
        return $this->request('PUT', '/'.$this->entity($entity)."/tags/{$tagId}", body: ['tag' => $tag]);
    }

    /**
     * Delete a tag definition.
     *
     * @param  string  $entity  Entity path.
     * @param  int  $tagId  Tag ID.
     * @return array<string, mixed>
     */
    public function deleteTag(string $entity, int $tagId): array
    {
        return $this->request('DELETE', '/'.$this->entity($entity)."/tags/{$tagId}");
    }

    /**
     * List custom field definitions.
     *
     * @param  string  $entity  Entity path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCustomFields(string $entity, array $params = []): array
    {
        return $this->request('GET', '/'.$this->entity($entity).'/fields/definitions', query: $params);
    }

    /**
     * Create a custom field definition.
     *
     * @param  string  $entity  Entity path.
     * @param  array<string, mixed>  $definition  Field definition payload.
     * @return array<string, mixed>
     */
    public function createCustomField(string $entity, array $definition): array
    {
        return $this->request('POST', '/'.$this->entity($entity).'/fields/definitions', body: ['definition' => $definition]);
    }

    /**
     * Update a custom field definition.
     *
     * @param  string  $entity  Entity path.
     * @param  int  $definitionId  Field definition ID.
     * @param  array<string, mixed>  $definition  Field definition payload.
     * @return array<string, mixed>
     */
    public function updateCustomField(string $entity, int $definitionId, array $definition): array
    {
        return $this->request('PUT', '/'.$this->entity($entity)."/fields/definitions/{$definitionId}", body: ['definition' => $definition]);
    }

    /**
     * Delete a custom field definition.
     *
     * @param  string  $entity  Entity path.
     * @param  int  $definitionId  Field definition ID.
     * @return array<string, mixed>
     */
    public function deleteCustomField(string $entity, int $definitionId): array
    {
        return $this->request('DELETE', '/'.$this->entity($entity)."/fields/definitions/{$definitionId}");
    }

    /*
    |--------------------------------------------------------------------------
    | User and raw helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Perform a raw GET request to a safe relative Capsule API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, query: $query);
    }

    /**
     * Perform a raw POST request to a safe relative Capsule API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, query: $query, body: $body);
    }

    /**
     * Perform a raw PUT request to a safe relative Capsule API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, query: $query, body: $body);
    }

    /**
     * Perform a raw DELETE request to a safe relative Capsule API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, query: $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path relative to base URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to Capsule.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Capsule CRM access token is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Capsule CRM API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Capsule CRM API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Capsule CRM API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Capsule CRM API: {$e->getMessage()}");
        }
    }

    /**
     * Build a safe URL below the configured Capsule API root.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('Capsule CRM API path must be a safe relative path.');
        }

        $path = '/'.ltrim($path, '/');
        $queryString = $this->buildQuery($query);

        return $this->baseUrl.$path.($queryString !== '' ? '?'.$queryString : '');
    }

    /**
     * Build a query string while preserving repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $pairs[] = rawurlencode((string) $key).'='.rawurlencode(is_scalar($item) ? (string) $item : json_encode($item, JSON_THROW_ON_ERROR));
                }
                continue;
            }

            $pairs[] = rawurlencode((string) $key).'='.rawurlencode((string) $value);
        }

        return implode('&', $pairs);
    }

    /**
     * Normalize and validate entity path names.
     */
    private function entity(string $entity): string
    {
        $entity = strtolower(trim($entity));
        $aliases = [
            'party' => 'parties',
            'contact' => 'parties',
            'contacts' => 'parties',
            'opportunity' => 'opportunities',
            'case' => 'kases',
            'cases' => 'kases',
            'project' => 'kases',
            'projects' => 'kases',
        ];

        $entity = $aliases[$entity] ?? $entity;
        if (!in_array($entity, ['parties', 'opportunities', 'kases'], true)) {
            throw new RuntimeException('Capsule CRM entity must be parties, opportunities, or kases.');
        }

        return $entity;
    }
}
