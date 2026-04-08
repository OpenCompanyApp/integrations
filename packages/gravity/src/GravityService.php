<?php

namespace OpenCompany\Integrations\Gravity;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GravityService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.gravity.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List forms.
     *
     * @param  int|null  $limit  Maximum number of forms to return.
     * @param  int|null  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listForms(?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/forms', $params);
    }

    /**
     * Get details for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId));
    }

    /**
     * Submit a form.
     *
     * @param  string  $formId  The form ID.
     * @param  array<string, mixed>  $data  Form submission data (field values).
     * @return array<string, mixed>
     */
    public function submitForm(string $formId, array $data): array
    {
        return $this->request('POST', '/forms/' . urlencode($formId) . '/submissions', $data);
    }

    /**
     * List submissions for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @param  int|null  $limit  Maximum number of submissions to return.
     * @param  int|null  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listSubmissions(string $formId, ?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/forms/' . urlencode($formId) . '/submissions', $params);
    }

    /**
     * List entries for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @param  int|null  $limit  Maximum number of entries to return.
     * @param  int|null  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listEntries(string $formId, ?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/forms/' . urlencode($formId) . '/entries', $params);
    }

    /**
     * Get a specific entry by ID.
     *
     * @param  string  $entryId  The entry ID.
     * @return array<string, mixed>
     */
    public function getEntry(string $entryId): array
    {
        return $this->request('GET', '/entries/' . urlencode($entryId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gravity API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Gravity API key is not configured.');
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

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Gravity API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Gravity API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? $body;
                Log::error("Gravity API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gravity API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gravity API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gravity API: {$e->getMessage()}");
        }
    }
}
