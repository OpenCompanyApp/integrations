<?php

namespace OpenCompany\Integrations\Wufoo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WufooService
{
    /**
     * Create a new Wufoo service instance.
     *
     * @param  string  $apiKey  The Wufoo API key used for HTTP Basic Auth (username).
     * @param  string  $subdomain  The Wufoo account subdomain (e.g., "mycompany" for mycompany.wufoo.com).
     */
    public function __construct(
        private string $apiKey = '',
        private string $subdomain = '',
    ) {}

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->subdomain);
    }

    /**
     * Build the base URL for the Wufoo API v3.
     *
     * @return string The fully-qualified base URL, e.g. "https://mycompany.wufoo.com/api/v3"
     */
    public function getBaseUrl(): string
    {
        return 'https://' . $this->subdomain . '.wufoo.com/api/v3';
    }

    /**
     * List all forms in the Wufoo account.
     *
     * @return array<string, mixed> The parsed JSON response containing the Forms array.
     */
    public function listForms(): array
    {
        return $this->request('GET', '/forms.json');
    }

    /**
     * Get details for a single form by its hash identifier.
     *
     * @param  string  $formId  The form hash or unique identifier.
     * @return array<string, mixed> The parsed JSON response containing the form details.
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '.json');
    }

    /**
     * List entries for a specific form.
     *
     * @param  string  $formId  The form hash or unique identifier.
     * @param  int  $pageSize  Number of entries per page (default 100, max 100).
     * @param  int  $pageStart  The entry index to start from (0-based).
     * @param  string|null  $sort  Sort direction: "ASC" or "DESC" (by EntryId).
     * @return array<string, mixed> The parsed JSON response containing entries.
     */
    public function listEntries(string $formId, int $pageSize = 100, int $pageStart = 0, ?string $sort = null): array
    {
        $params = [
            'pageSize' => min($pageSize, 100),
            'pageStart' => $pageStart,
        ];

        if ($sort !== null) {
            $params['sort'] = $sort;
        }

        return $this->request('GET', '/forms/' . urlencode($formId) . '/entries.json', $params);
    }

    /**
     * Get a single entry by its identifier.
     *
     * @param  string  $entryId  The unique entry identifier.
     * @return array<string, mixed> The parsed JSON response containing the entry data.
     */
    public function getEntry(string $entryId): array
    {
        return $this->request('GET', '/entries/' . urlencode($entryId) . '.json');
    }

    /**
     * Submit a new entry to a form.
     *
     * @param  string  $formId  The form hash or unique identifier.
     * @param  array<string, mixed>  $fields  Associative array of field values keyed by field API IDs (e.g., ["Field1" => "value"]).
     * @return array<string, mixed> The parsed JSON response with success status and entry ID.
     */
    public function submitEntry(string $formId, array $fields): array
    {
        return $this->request('POST', '/forms/' . urlencode($formId) . '/entries.json', [], $fields);
    }

    /**
     * List all fields for a specific form.
     *
     * @param  string  $formId  The form hash or unique identifier.
     * @return array<string, mixed> The parsed JSON response containing the Fields array.
     */
    public function listFields(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '/fields.json');
    }

    /**
     * List all reports in the Wufoo account.
     *
     * @return array<string, mixed> The parsed JSON response containing the Reports array.
     */
    public function listReports(): array
    {
        return $this->request('GET', '/reports.json');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path (e.g., "/forms.json").
     * @param  array<string, mixed>  $query  Query parameters for GET requests.
     * @param  array<string, mixed>  $body  Form data for POST requests (URL-encoded).
     * @return array<string, mixed> The parsed JSON response body.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Wufoo API using HTTP Basic Auth.
     *
     * Wufoo uses HTTP Basic Auth where the API key is the username and the password is "foot".
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  POST body data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the service is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->subdomain) {
            throw new \RuntimeException('Wufoo integration is not configured. API key and subdomain are required.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, 'foot')
                ->withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->asForm()->post($url, $body),
                'PUT' => $http->asForm()->put($url, $body),
                'DELETE' => $http->delete($url, $query),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $responseBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($responseBody), '<!DOCTYPE')) {
                    Log::warning("Wufoo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Wufoo API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the account may lack permissions.");
                }

                $error = $response->json('Error') ?? $response->json('error') ?? $responseBody;
                Log::error("Wufoo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Wufoo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Wufoo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Wufoo API: {$e->getMessage()}");
        }
    }
}
