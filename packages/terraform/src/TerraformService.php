<?php

namespace OpenCompany\Integrations\Terraform;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Terraform Cloud API service for communicating with Terraform Cloud.
 *
 * Handles authentication via Bearer tokens and provides methods for
 * workspaces, runs, variables, organizations, and user management.
 */
class TerraformService
{
    /**
     * Create a new TerraformService instance.
     *
     * @param string $apiToken The Terraform Cloud API token.
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * Get the configured base URL for the Terraform Cloud API.
     */
    public function getBaseUrl(): string
    {
        return 'https://api.terraform.io/v2';
    }

    /**
     * List workspaces for an organization.
     *
     * @param string $organization The organization name.
     * @param int $pageNumber Page number (1-based).
     * @param int $pageSize Number of results per page (max 100).
     * @return array<string, mixed>
     */
    public function listWorkspaces(string $organization, int $pageNumber = 1, int $pageSize = 20): array
    {
        return $this->request('GET', '/organizations/' . urlencode($organization) . '/workspaces', [
            'page[number]' => $pageNumber,
            'page[size]' => $pageSize,
        ]);
    }

    /**
     * Get a workspace by ID.
     *
     * @param string $workspaceId The workspace ID.
     * @return array<string, mixed>
     */
    public function getWorkspace(string $workspaceId): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($workspaceId));
    }

    /**
     * List runs for a workspace.
     *
     * @param string $workspaceId The workspace ID.
     * @param int $pageNumber Page number (1-based).
     * @param int $pageSize Number of results per page (max 100).
     * @return array<string, mixed>
     */
    public function listRuns(string $workspaceId, int $pageNumber = 1, int $pageSize = 20): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($workspaceId) . '/runs', [
            'page[number]' => $pageNumber,
            'page[size]' => $pageSize,
        ]);
    }

    /**
     * Get a run by ID.
     *
     * @param string $runId The run ID.
     * @return array<string, mixed>
     */
    public function getRun(string $runId): array
    {
        return $this->request('GET', '/runs/' . urlencode($runId));
    }

    /**
     * List variables for a workspace.
     *
     * @param string $workspaceId The workspace ID.
     * @return array<string, mixed>
     */
    public function listVariables(string $workspaceId): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($workspaceId) . '/vars');
    }

    /**
     * List organizations the authenticated user has access to.
     *
     * @param int $pageNumber Page number (1-based).
     * @param int $pageSize Number of results per page (max 50).
     * @return array<string, mixed>
     */
    public function listOrganizations(int $pageNumber = 1, int $pageSize = 20): array
    {
        return $this->request('GET', '/organizations', [
            'page[number]' => $pageNumber,
            'page[size]' => $pageSize,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account/details');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path API path (relative to /v2).
     * @param array<string, mixed> $data Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Terraform Cloud API.
     *
     * @param string $method HTTP method.
     * @param string $path API path relative to /v2.
     * @param array<string, mixed> $data Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API token is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Terraform Cloud API token is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/vnd.api+json',
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Terraform Cloud API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Terraform Cloud API endpoint not available (HTTP {$response->status()}). Check your API path.");
                }

                $error = $response->json('errors.0.detail') ?? $response->json('errors.0.title') ?? $response->json('message') ?? $body;
                Log::error("Terraform Cloud API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Terraform Cloud API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Terraform Cloud API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Terraform Cloud API: {$e->getMessage()}");
        }
    }
}
