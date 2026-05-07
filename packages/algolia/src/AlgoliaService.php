<?php

namespace OpenCompany\Integrations\Algolia;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Service class for interacting with the Algolia Search API.
 *
 * Handles authentication via X-Algolia-Application-Id and X-Algolia-API-Key headers.
 * Uses the write endpoint ({appId}.algolia.net) for write operations
 * and the search endpoint ({appId}-dsn.algolia.net) for search queries.
 */
class AlgoliaService
{
    private string $appId;
    private string $apiKey;
    private string $writeBaseUrl;
    private string $searchBaseUrl;

    /**
     * @param string $appId  Algolia Application ID
     * @param string $apiKey Algolia Admin API Key
     */
    public function __construct(string $appId = '', string $apiKey = '')
    {
        $this->appId = $appId;
        $this->apiKey = $apiKey;
        $this->writeBaseUrl = $appId ? "https://{$appId}.algolia.net/1" : '';
        $this->searchBaseUrl = $appId ? "https://{$appId}-dsn.algolia.net/1" : '';
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->appId) && !empty($this->apiKey);
    }

    /**
     * Get the Algolia Application ID.
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Search an index using the Algolia search endpoint (read replica).
     *
     * @param string $indexName The index to search
     * @param array  $body      Search parameters (query, filters, hitsPerPage, etc.)
     * @return array<string, mixed>
     */
    public function search(string $indexName, array $body): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/query', body: $body, useSearchEndpoint: true);
    }

    /**
     * Search multiple indices in one request.
     *
     * @param  array<int, array<string, mixed>>  $requests  Algolia multiple-query request objects.
     * @param  string  $strategy  Multiple query strategy.
     * @return array<string, mixed>
     */
    public function searchMultiple(array $requests, string $strategy = 'none'): array
    {
        return $this->request('POST', '/indexes/*/queries', body: [
            'requests' => $requests,
            'strategy' => $strategy,
        ], useSearchEndpoint: true);
    }

    /**
     * Browse records in an index for exports and full index scans.
     *
     * @param  string  $indexName  The index name.
     * @param  array<string, mixed>  $body  Browse parameters.
     * @return array<string, mixed>
     */
    public function browse(string $indexName, array $body = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/browse', body: $body);
    }

    /**
     * Search facet values for a facet attribute.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $facetName  Facet attribute name.
     * @param  array<string, mixed>  $body  Facet search parameters.
     * @return array<string, mixed>
     */
    public function searchFacetValues(string $indexName, string $facetName, array $body): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/facets/'.$this->segment($facetName).'/query', body: $body, useSearchEndpoint: true);
    }

    /**
     * Get a single object by its objectID.
     *
     * @param string $indexName The index name
     * @param string $objectID  The object's unique identifier
     * @return array<string, mixed>
     */
    public function getObject(string $indexName, string $objectID): array
    {
        return $this->request('GET', '/indexes/'.$this->segment($indexName).'/'.$this->segment($objectID));
    }

    /**
     * Save (create or replace) an object in an index.
     *
     * @param string $indexName The index name
     * @param string $objectID  The object's unique identifier
     * @param array  $body      The object data to save
     * @return array<string, mixed>
     */
    public function saveObject(string $indexName, string $objectID, array $body): array
    {
        return $this->request('PUT', '/indexes/'.$this->segment($indexName).'/'.$this->segment($objectID), body: $body);
    }

    /**
     * Delete an object from an index.
     *
     * @param string $indexName The index name
     * @param string $objectID  The object's unique identifier
     * @return array<string, mixed>
     */
    public function deleteObject(string $indexName, string $objectID): array
    {
        return $this->request('DELETE', '/indexes/'.$this->segment($indexName).'/'.$this->segment($objectID));
    }

    /**
     * Partially update an object's attributes.
     *
     * @param string $indexName  The index name
     * @param string $objectID   The object's unique identifier
     * @param array  $attributes The attributes to update
     * @return array<string, mixed>
     */
    public function partialUpdate(string $indexName, string $objectID, array $attributes): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/'.$this->segment($objectID).'/partial', body: $attributes);
    }

    /**
     * List all indices in the application.
     *
     * @return array<string, mixed>
     */
    public function listIndices(): array
    {
        return $this->request('GET', '/indexes');
    }

    /**
     * Get the settings of an index.
     *
     * @param string $indexName The index name
     * @return array<string, mixed>
     */
    public function getSettings(string $indexName, array $query = []): array
    {
        return $this->request('GET', '/indexes/'.$this->segment($indexName).'/settings', query: $query);
    }

    /**
     * Update the settings of an index.
     *
     * @param  string  $indexName  The index name.
     * @param  array<string, mixed>  $settings  Index settings.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function setSettings(string $indexName, array $settings, array $query = []): array
    {
        return $this->request('PUT', '/indexes/'.$this->segment($indexName).'/settings', query: $query, body: $settings);
    }

    /**
     * Clear all objects from an index.
     *
     * @param string $indexName The index name
     * @return array<string, mixed>
     */
    public function clearIndex(string $indexName): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/clear');
    }

    /**
     * Delete an index and its records.
     *
     * @param  string  $indexName  The index name.
     * @return array<string, mixed>
     */
    public function deleteIndex(string $indexName): array
    {
        return $this->request('DELETE', '/indexes/'.$this->segment($indexName));
    }

    /**
     * Run an index operation such as copy or move.
     *
     * @param  string  $indexName  Source index name.
     * @param  string  $operation  Algolia operation name.
     * @param  string  $destination  Destination index name.
     * @param  array<string, mixed>  $extra  Additional operation payload.
     * @return array<string, mixed>
     */
    public function indexOperation(string $indexName, string $operation, string $destination, array $extra = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/operation', body: array_merge($extra, [
            'operation' => $operation,
            'destination' => $destination,
        ]));
    }

    /**
     * Perform a batch operation on an index.
     *
     * @param string $indexName The index name
     * @param array  $requests  Array of batch requests
     * @return array<string, mixed>
     */
    public function batch(string $indexName, array $requests): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/batch', body: [
            'requests' => $requests,
        ]);
    }

    /**
     * Get the status of an asynchronous indexing task.
     *
     * @param  string  $indexName  The index name.
     * @param  int|string  $taskId  Algolia task ID.
     * @return array<string, mixed>
     */
    public function getTask(string $indexName, int|string $taskId): array
    {
        return $this->request('GET', '/indexes/'.$this->segment($indexName).'/task/'.$this->segment((string) $taskId));
    }

    /*
    |--------------------------------------------------------------------------
    | Synonyms
    |--------------------------------------------------------------------------
    */

    /**
     * Search synonyms in an index.
     *
     * @param  string  $indexName  The index name.
     * @param  array<string, mixed>  $body  Synonym search parameters.
     * @return array<string, mixed>
     */
    public function searchSynonyms(string $indexName, array $body = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/synonyms/search', body: $body);
    }

    /**
     * Get one synonym by objectID.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $objectID  Synonym object ID.
     * @return array<string, mixed>
     */
    public function getSynonym(string $indexName, string $objectID): array
    {
        return $this->request('GET', '/indexes/'.$this->segment($indexName).'/synonyms/'.$this->segment($objectID));
    }

    /**
     * Save one synonym.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $objectID  Synonym object ID.
     * @param  array<string, mixed>  $body  Synonym payload.
     * @return array<string, mixed>
     */
    public function saveSynonym(string $indexName, string $objectID, array $body): array
    {
        return $this->request('PUT', '/indexes/'.$this->segment($indexName).'/synonyms/'.$this->segment($objectID), body: $body);
    }

    /**
     * Delete one synonym.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $objectID  Synonym object ID.
     * @return array<string, mixed>
     */
    public function deleteSynonym(string $indexName, string $objectID): array
    {
        return $this->request('DELETE', '/indexes/'.$this->segment($indexName).'/synonyms/'.$this->segment($objectID));
    }

    /**
     * Save multiple synonyms.
     *
     * @param  string  $indexName  The index name.
     * @param  array<int, array<string, mixed>>  $synonyms  Synonym objects.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function batchSynonyms(string $indexName, array $synonyms, array $query = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/synonyms/batch', query: $query, body: $synonyms);
    }

    /**
     * Clear synonyms from an index.
     *
     * @param  string  $indexName  The index name.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function clearSynonyms(string $indexName, array $query = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/synonyms/clear', query: $query);
    }

    /*
    |--------------------------------------------------------------------------
    | Rules
    |--------------------------------------------------------------------------
    */

    /**
     * Search rules in an index.
     *
     * @param  string  $indexName  The index name.
     * @param  array<string, mixed>  $body  Rule search parameters.
     * @return array<string, mixed>
     */
    public function searchRules(string $indexName, array $body = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/rules/search', body: $body);
    }

    /**
     * Get one rule by objectID.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $objectID  Rule object ID.
     * @return array<string, mixed>
     */
    public function getRule(string $indexName, string $objectID): array
    {
        return $this->request('GET', '/indexes/'.$this->segment($indexName).'/rules/'.$this->segment($objectID));
    }

    /**
     * Save one rule.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $objectID  Rule object ID.
     * @param  array<string, mixed>  $body  Rule payload.
     * @return array<string, mixed>
     */
    public function saveRule(string $indexName, string $objectID, array $body): array
    {
        return $this->request('PUT', '/indexes/'.$this->segment($indexName).'/rules/'.$this->segment($objectID), body: $body);
    }

    /**
     * Delete one rule.
     *
     * @param  string  $indexName  The index name.
     * @param  string  $objectID  Rule object ID.
     * @return array<string, mixed>
     */
    public function deleteRule(string $indexName, string $objectID): array
    {
        return $this->request('DELETE', '/indexes/'.$this->segment($indexName).'/rules/'.$this->segment($objectID));
    }

    /**
     * Save multiple rules.
     *
     * @param  string  $indexName  The index name.
     * @param  array<int, array<string, mixed>>  $rules  Rule objects.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function batchRules(string $indexName, array $rules, array $query = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/rules/batch', query: $query, body: $rules);
    }

    /**
     * Clear rules from an index.
     *
     * @param  string  $indexName  The index name.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function clearRules(string $indexName, array $query = []): array
    {
        return $this->request('POST', '/indexes/'.$this->segment($indexName).'/rules/clear', query: $query);
    }

    /*
    |--------------------------------------------------------------------------
    | Keys, logs, and raw helpers
    |--------------------------------------------------------------------------
    */

    /**
     * List API keys (used to verify authentication).
     *
     * @return array<string, mixed>
     */
    public function listApiKeys(): array
    {
        return $this->request('GET', '/keys');
    }

    /**
     * Get an API key by value.
     *
     * @param  string  $key  API key value.
     * @return array<string, mixed>
     */
    public function getApiKey(string $key): array
    {
        return $this->request('GET', '/keys/'.$this->segment($key));
    }

    /**
     * Add an API key.
     *
     * @param  array<string, mixed>  $body  Key restrictions and ACLs.
     * @return array<string, mixed>
     */
    public function addApiKey(array $body): array
    {
        return $this->request('POST', '/keys', body: $body);
    }

    /**
     * Update an API key.
     *
     * @param  string  $key  API key value.
     * @param  array<string, mixed>  $body  Key restrictions and ACLs.
     * @return array<string, mixed>
     */
    public function updateApiKey(string $key, array $body): array
    {
        return $this->request('PUT', '/keys/'.$this->segment($key), body: $body);
    }

    /**
     * Delete an API key.
     *
     * @param  string  $key  API key value.
     * @return array<string, mixed>
     */
    public function deleteApiKey(string $key): array
    {
        return $this->request('DELETE', '/keys/'.$this->segment($key));
    }

    /**
     * List recent Algolia logs.
     *
     * @param  array<string, mixed>  $query  Log query parameters.
     * @return array<string, mixed>
     */
    public function listLogs(array $query = []): array
    {
        return $this->request('GET', '/logs', query: $query);
    }

    /**
     * Perform a raw GET request to a safe relative Algolia API path.
     *
     * @param  string  $path  Relative path below /1.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  bool  $useSearchEndpoint  Whether to use the DSN endpoint.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = [], bool $useSearchEndpoint = false): array
    {
        return $this->request('GET', $path, query: $query, useSearchEndpoint: $useSearchEndpoint);
    }

    /**
     * Perform a raw POST request to a safe relative Algolia API path.
     *
     * @param  string  $path  Relative path below /1.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  bool  $useSearchEndpoint  Whether to use the DSN endpoint.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = [], bool $useSearchEndpoint = false): array
    {
        return $this->request('POST', $path, query: $query, body: $body, useSearchEndpoint: $useSearchEndpoint);
    }

    /**
     * Perform a raw PUT request to a safe relative Algolia API path.
     *
     * @param  string  $path  Relative path below /1.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, query: $query, body: $body);
    }

    /**
     * Perform a raw DELETE request to a safe relative Algolia API path.
     *
     * @param  string  $path  Relative path below /1.
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
     * @param bool $useSearchEndpoint Whether to use the DSN (search) endpoint
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = [], bool $useSearchEndpoint = false): array
    {
        $response = $this->rawRequest($method, $path, $query, $body, $useSearchEndpoint);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Algolia API.
     *
     * @param bool $useSearchEndpoint Whether to use the DSN (search) endpoint
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = [], bool $useSearchEndpoint = false): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Algolia is not configured. Application ID and API Key are required.');
        }

        $baseUrl = $useSearchEndpoint ? $this->searchBaseUrl : $this->writeBaseUrl;
        $url = $this->buildUrl($baseUrl, $path, $query);

        try {
            $http = Http::withHeaders([
                'X-Algolia-Application-Id' => $this->appId,
                'X-Algolia-API-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("Algolia API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Algolia API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Algolia API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Algolia API: {$e->getMessage()}");
        }
    }

    /**
     * URL-encode one path segment.
     */
    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    /**
     * Build a safe Algolia URL below the /1 API root.
     *
     * @param  string  $baseUrl  API base URL.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $baseUrl, string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('Algolia API path must be a safe relative path.');
        }

        $path = '/' . ltrim($path, '/');
        $queryString = $this->buildQuery($query);

        return $baseUrl . $path . ($queryString !== '' ? '?' . $queryString : '');
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
}
