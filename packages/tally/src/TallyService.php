<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TallyService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.tally.so',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Tally integration is configured (has an API key).
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all forms accessible to the authenticated user.
     *
     * @param  int  $limit   Maximum number of forms to return (default: 100).
     * @param  string|null  $after  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listForms(int $limit = 100, ?string $after = null): array
    {
        $params = ['limit' => $limit];
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/forms', $params);
    }

    /**
     * Get details for a single form by its ID.
     *
     * @param  string  $formId  The Tally form ID.
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/' . urlencode($formId));
    }

    /**
     * List submissions for a specific form.
     *
     * @param  string  $formId  The Tally form ID.
     * @param  int  $limit  Maximum number of submissions to return.
     * @param  string|null  $after  Cursor for pagination.
     * @param  string|null submittedAfter  ISO 8601 date to filter submissions after.
     * @param  string|null  $submittedBefore  ISO 8601 date to filter submissions before.
     * @return array<string, mixed>
     */
    public function listSubmissions(
        string $formId,
        int $limit = 100,
        ?string $after = null,
        ?string $submittedAfter = null,
        ?string $submittedBefore = null,
    ): array {
        $params = ['limit' => $limit];
        if ($after) {
            $params['after'] = $after;
        }
        if ($submittedAfter) {
            $params['submittedAfter'] = $submittedAfter;
        }
        if ($submittedBefore) {
            $params['submittedBefore'] = $submittedBefore;
        }

        return $this->request('GET', '/forms/' . urlencode($formId) . '/submissions', $params);
    }

    /**
     * Get a single submission by its ID.
     *
     * @param  string  $submissionId  The Tally submission ID.
     * @return array<string, mixed>
     */
    public function getSubmission(string $submissionId): array
    {
        return $this->request('GET', '/submissions/' . urlencode($submissionId));
    }

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/workspaces');
    }

    /**
     * Get the currently authenticated Tally user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
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

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Tally API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Tally API key is not configured.');
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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Tally API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Tally API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
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
