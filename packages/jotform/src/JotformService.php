<?php

namespace OpenCompany\Integrations\Jotform;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JotformService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.jotform.com',
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
     * List forms owned by the authenticated user.
     *
     * @param  int|null  $limit  Maximum number of forms to return (default: 20, max: 1000).
     * @param  int|null  $offset  Offset for pagination.
     * @param  array<string, mixed>  $filters  Optional filter parameters (e.g. status, title, etc.).
     * @param  string|null  $orderBy  Order field (e.g. "created_at", "title", "id").
     * @return array<string, mixed>
     */
    public function listForms(?int $limit = null, ?int $offset = null, array $filters = [], ?string $orderBy = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }
        if ($orderBy !== null) {
            $params['orderby'] = $orderBy;
        }
        foreach ($filters as $key => $value) {
            $params[$key] = $value;
        }

        return $this->request('GET', '/user/forms', $params);
    }

    /**
     * Get details for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/form/' . urlencode($formId));
    }

    /**
     * Create a new form.
     *
     * @param  array<string, mixed>  $properties  Form properties (title, questions, etc.).
     * @return array<string, mixed>
     */
    public function createForm(array $properties): array
    {
        return $this->request('POST', '/user/forms', $properties);
    }

    /**
     * List submissions for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @param  int|null  $limit  Maximum number of submissions to return (default: 20, max: 1000).
     * @param  int|null  $offset  Offset for pagination.
     * @param  array<string, mixed>  $filters  Optional filter parameters.
     * @param  string|null  $orderBy  Order field (e.g. "created_at", "id").
     * @return array<string, mixed>
     */
    public function listSubmissions(string $formId, ?int $limit = null, ?int $offset = null, array $filters = [], ?string $orderBy = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }
        if ($orderBy !== null) {
            $params['orderby'] = $orderBy;
        }
        foreach ($filters as $key => $value) {
            $params[$key] = $value;
        }

        return $this->request('GET', '/form/' . urlencode($formId) . '/submissions', $params);
    }

    /**
     * Get a specific submission by ID.
     *
     * @param  string  $submissionId  The submission ID.
     * @return array<string, mixed>
     */
    public function getSubmission(string $submissionId): array
    {
        return $this->request('GET', '/submission/' . urlencode($submissionId));
    }

    /**
     * List questions for a specific form.
     *
     * @param  string  $formId  The form ID.
     * @param  int|null  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listQuestions(string $formId, ?int $offset = null): array
    {
        $params = [];
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/form/' . urlencode($formId) . '/questions', $params);
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
     * Make a raw HTTP request to the Jotform API.
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
            throw new \RuntimeException('Jotform API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'JotAPI-Key' => $this->apiKey,
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
                    Log::warning("Jotform API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Jotform API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? $body;
                Log::error("Jotform API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Jotform API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Jotform API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Jotform API: {$e->getMessage()}");
        }
    }
}
