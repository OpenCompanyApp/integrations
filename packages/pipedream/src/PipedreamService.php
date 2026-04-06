<?php

namespace OpenCompany\Integrations\Pipedream;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PipedreamService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.pipedream.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List workflows.
     *
     * @param  int  $page  Page number for pagination.
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listWorkflows(int $page = 1, int $limit = 25): array
    {
        return $this->request('GET', '/v1/workflows', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single workflow by ID.
     *
     * @param  string  $id  The workflow ID.
     * @return array<string, mixed>
     */
    public function getWorkflow(string $id): array
    {
        return $this->request('GET', '/v1/workflows/' . urlencode($id));
    }

    /**
     * List components.
     *
     * @param  string|null  $type  Component type filter (e.g., "action", "trigger").
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listComponents(?string $type = null, int $limit = 25): array
    {
        $params = ['limit' => $limit];
        if ($type) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/v1/components', $params);
    }

    /**
     * Get a single component by app and ID.
     *
     * @param  string  $app  The app slug (e.g., "slack", "github").
     * @param  string  $id  The component key or ID.
     * @return array<string, mixed>
     */
    public function getComponent(string $app, string $id): array
    {
        return $this->request('GET', '/v1/components/' . urlencode($app) . '/' . urlencode($id));
    }

    /**
     * List connected accounts.
     *
     * @param  int  $page  Page number for pagination.
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listConnectedAccounts(int $page = 1, int $limit = 25): array
    {
        return $this->request('GET', '/v1/accounts', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * List triggers for a workflow.
     *
     * @param  string  $workflowId  The workflow ID to list triggers for.
     * @return array<string, mixed>
     */
    public function listTriggers(string $workflowId): array
    {
        return $this->request('GET', '/v1/triggers', [
            'workflow_id' => $workflowId,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pipedream API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Pipedream access token is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Pipedream API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Pipedream API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Pipedream API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Pipedream API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pipedream API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pipedream API: {$e->getMessage()}");
        }
    }
}
