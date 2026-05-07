<?php

namespace OpenCompany\Integrations\Wufoo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Wufoo API service for interacting with the Wufoo forms platform.
 *
 * Handles HTTP Basic authentication (API key as username, "footastic" as password)
 * and provides methods for forms, entries, reports, and user operations.
 */
class WufooService
{
    /**
     * Create a new WufooService instance.
     *
     * @param  string  $apiKey  The Wufoo API key used as the HTTP Basic Auth username.
     * @param  string  $baseUrl  The base URL for the Wufoo API (e.g., https://{subdomain}.wufoo.com/api/v3).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://example.wufoo.com/api/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // ── Forms ──────────────────────────────────────────────

    /**
     * List all forms accessible to the authenticated user.
     *
     * @return array<string, mixed> The list of forms from the Wufoo API.
     */
    public function listForms(array $params = []): array
    {
        return $this->request('GET', '/forms.json', $params);
    }

    /**
     * Get details for a specific form by its identifier.
     *
     * @param  string  $formId  The form hash or identifier.
     * @return array<string, mixed> The form details from the Wufoo API.
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '.json');
    }

    /**
     * List fields for a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as system or pretty.
     * @return array<string, mixed> The field structure for the form.
     */
    public function listFields(string $formId, array $params = []): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '/fields.json', $params);
    }

    /**
     * List comments for entries on a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as entryId, pageStart, or pageSize.
     * @return array<string, mixed> The comments response.
     */
    public function listFormComments(string $formId, array $params = []): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '/comments.json', $params);
    }

    /**
     * Count comments for entries on a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as pretty.
     * @return array<string, mixed> The comment count response.
     */
    public function countFormComments(string $formId, array $params = []): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '/comments/count.json', $params);
    }

    // ── Entries ────────────────────────────────────────────

    /**
     * List entries for a specific form with optional pagination and filters.
     *
     * @param  string  $formId  The form hash or identifier.
     * @param  int  $page  The page number (0-based).
     * @param  int  $pageSize  Number of entries per page (default 25, max 100).
     * @param  array<string, mixed>  $filters  Optional field filters to apply.
     * @return array<string, mixed> The paginated list of entries.
     */
    public function listEntries(string $formId, int $page = 0, int $pageSize = 25, array $filters = []): array
    {
        $params = [
            'pageStart' => $page,
            'pageSize' => min($pageSize, 100),
        ];

        foreach ($filters as $key => $value) {
            $params[$key] = $value;
        }

        return $this->request('GET', '/forms/' . urlencode($formId) . '/entries.json', $params);
    }

    /**
     * Count entries for a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  array<string, mixed>  $params  Filter and pretty-print query parameters.
     * @return array<string, mixed> The entry count response.
     */
    public function countEntries(string $formId, array $params = []): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId) . '/entries/count.json', $params);
    }

    /**
     * Find a single entry within a form by entry identifier.
     *
     * Wufoo API v3 exposes entries under forms, so this uses the documented
     * form entries endpoint with an EntryId filter and page size of one.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  string  $entryId  The entry identifier.
     * @return array<string, mixed> The filtered entry response.
     */
    public function getEntry(string $formId, string $entryId): array
    {
        return $this->listEntries($formId, 0, 1, [
            'Filter1' => "EntryId+Is_equal_to+{$entryId}",
        ]);
    }

    /**
     * Submit a new entry to a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  array<string, mixed>  $fields  Wufoo field values keyed by API field IDs.
     * @return array<string, mixed> The submission response.
     */
    public function submitEntry(string $formId, array $fields): array
    {
        return $this->request('POST', '/forms/' . urlencode($formId) . '/entries.json', $fields, true);
    }

    // ── Reports ────────────────────────────────────────────

    /**
     * List all reports accessible to the authenticated user.
     *
     * @return array<string, mixed> The list of reports from the Wufoo API.
     */
    public function listReports(array $params = []): array
    {
        return $this->request('GET', '/reports.json', $params);
    }

    /**
     * Get details for a specific report.
     *
     * @param  string  $reportId  The report hash or title identifier.
     * @return array<string, mixed> The report details.
     */
    public function getReport(string $reportId): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId) . '.json');
    }

    /**
     * List entries exposed by a specific report.
     *
     * @param  string  $reportId  The report hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as pageStart, pageSize, sort, or filters.
     * @return array<string, mixed> The report entries response.
     */
    public function listReportEntries(string $reportId, array $params = []): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId) . '/entries.json', $params);
    }

    /**
     * Count entries exposed by a specific report.
     *
     * @param  string  $reportId  The report hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as pretty.
     * @return array<string, mixed> The report entry count response.
     */
    public function countReportEntries(string $reportId, array $params = []): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId) . '/entries/count.json', $params);
    }

    /**
     * List fields for a specific report.
     *
     * @param  string  $reportId  The report hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as system or pretty.
     * @return array<string, mixed> The report field response.
     */
    public function listReportFields(string $reportId, array $params = []): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId) . '/fields.json', $params);
    }

    /**
     * List widgets for a specific report.
     *
     * @param  string  $reportId  The report hash or title identifier.
     * @param  array<string, mixed>  $params  Query parameters such as pretty.
     * @return array<string, mixed> The report widgets response.
     */
    public function listReportWidgets(string $reportId, array $params = []): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId) . '/widgets.json', $params);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed> The user profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users.json');
    }

    /**
     * List Wufoo users for the account.
     *
     * @param  array<string, mixed>  $params  Query parameters such as pretty.
     * @return array<string, mixed> The users response.
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users.json', $params);
    }

    // ── Webhooks ───────────────────────────────────────────

    /**
     * Add a webhook to a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  string  $url  The webhook target URL.
     * @param  string|null  $handshakeKey  Optional secret sent with webhook payloads.
     * @param  bool  $metadata  Whether Wufoo should include form and field metadata.
     * @return array<string, mixed> The webhook creation response.
     */
    public function addWebhook(string $formId, string $url, ?string $handshakeKey = null, bool $metadata = false): array
    {
        $payload = [
            'url' => $url,
            'metadata' => $metadata ? 'true' : 'false',
        ];

        if ($handshakeKey !== null && $handshakeKey !== '') {
            $payload['handshakeKey'] = $handshakeKey;
        }

        return $this->request('PUT', '/forms/' . urlencode($formId) . '/webhooks.json', $payload, true);
    }

    /**
     * Delete a webhook from a specific form.
     *
     * @param  string  $formId  The form hash or title identifier.
     * @param  string  $webhookId  The webhook hash identifier.
     * @return array<string, mixed> The webhook deletion response.
     */
    public function deleteWebhook(string $formId, string $webhookId): array
    {
        return $this->request('DELETE', '/forms/' . urlencode($formId) . '/webhooks/' . urlencode($webhookId) . '.json');
    }

    // ── Generic API ────────────────────────────────────────

    /**
     * Call a documented Wufoo API v3 GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to /api/v3.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Call a documented Wufoo API v3 POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to /api/v3.
     * @param  array<string, mixed>  $body  Form-encoded request body.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $body, true);
    }

    /**
     * Call a documented Wufoo API v3 PUT endpoint.
     *
     * @param  string  $path  Endpoint path relative to /api/v3.
     * @param  array<string, mixed>  $body  Form-encoded request body.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $body, true);
    }

    /**
     * Call a documented Wufoo API v3 DELETE endpoint.
     *
     * @param  string  $path  Endpoint path relative to /api/v3.
     * @param  array<string, mixed>  $params  Request parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function apiDelete(string $path, array $params = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API path (e.g., /forms.json).
     * @param  array<string, mixed>  $params  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
     *
     * @throws \RuntimeException If the API key is not configured or the request fails.
     */
    private function request(string $method, string $path, array $params = [], bool $asForm = false): array
    {
        $response = $this->rawRequest($method, $path, $params, $asForm);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Wufoo API with HTTP Basic authentication.
     *
     * Uses the API key as the username and "footastic" as the password,
     * following Wufoo's authentication convention.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API path.
     * @param  array<string, mixed>  $params  Query parameters or request body.
     * @param  bool  $asForm  Whether to submit body parameters as form data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $params = [], bool $asForm = false): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Wufoo API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, 'footastic')->timeout(30);

            $http = $asForm
                ? $http->asForm()
                : $http->withHeaders(['Content-Type' => 'application/json']);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $json = $response->json();
                $error = $json['error'] ?? $json['Text'] ?? $body;

                Log::error("Wufoo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Wufoo API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Wufoo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Wufoo API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a user-supplied endpoint path for generic helpers.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);
        $path = preg_replace('#^https?://[^/]+/api/v3#', '', $path) ?? $path;
        $path = '/' . ltrim($path, '/');

        if ($path === '/') {
            throw new \InvalidArgumentException('A Wufoo API path is required.');
        }

        return $path;
    }
}
