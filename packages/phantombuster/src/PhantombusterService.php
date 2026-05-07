<?php

namespace OpenCompany\Integrations\Phantombuster;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Phantombuster API v2.
 *
 * Handles authentication, endpoint mapping, error logging, and response parsing
 * for agents, containers, scripts, organization metadata, and generic API calls.
 */
class PhantombusterService
{
    /**
     * @param  string  $apiKey  Phantombuster API key.
     * @param  string  $baseUrl  Phantombuster API v2 base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.phantombuster.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List agents in the current organization.
     *
     * @param  array<string, mixed>  $params  Filters such as inputTypes, outputTypes, agentIds, withArgument, and withAgentSlotsFactor.
     * @return array<string, mixed>
     */
    public function listAgents(array $params = []): array
    {
        return $this->request('GET', '/agents/fetch-all', $params);
    }

    /**
     * Get a single agent by ID.
     *
     * @param  string  $id  Agent ID.
     * @param  array<string, mixed>  $params  Include flags such as withManifest, withAgentObject, withCode, withSlaves, and withSubSlaves.
     * @return array<string, mixed>
     */
    public function getAgent(string $id, array $params = []): array
    {
        return $this->request('GET', '/agents/fetch', array_merge(['id' => $id], $params));
    }

    /**
     * Create or update an agent.
     *
     * @param  array<string, mixed>  $payload  Agent upsert fields accepted by /agents/save.
     * @return array<string, mixed>
     */
    public function saveAgent(array $payload): array
    {
        return $this->request('POST', '/agents/save', $payload);
    }

    /**
     * Delete an agent.
     *
     * @param  string  $id  Agent ID.
     * @return array<string, mixed>
     */
    public function deleteAgent(string $id): array
    {
        return $this->request('POST', '/agents/delete', ['id' => $id]);
    }

    /**
     * Stop a running agent.
     *
     * @param  string  $id  Agent ID.
     * @return array<string, mixed>
     */
    public function stopAgent(string $id): array
    {
        return $this->request('POST', '/agents/stop', ['id' => $id]);
    }

    /**
     * Launch an agent by ID.
     *
     * @param  string  $id  The agent ID to launch.
     * @param  array<string, mixed>  $payload  Optional launch override fields such as argument, bonusArgument, saveArgument, and idempotencyKey.
     * @return array<string, mixed>
     */
    public function launchAgent(string $id, array $payload = []): array
    {
        return $this->request('POST', '/agents/launch', array_merge($payload, ['id' => $id]));
    }

    /**
     * List deleted agents in the current organization.
     *
     * @return array<string, mixed>
     */
    public function listDeletedAgents(): array
    {
        return $this->request('GET', '/agents/fetch-deleted');
    }

    /**
     * Fetch incremental output from the latest relevant container of an agent.
     *
     * @param  string  $id  Agent ID.
     * @param  array<string, mixed>  $params  Incremental output options.
     * @return array<string, mixed>
     */
    public function fetchAgentOutput(string $id, array $params = []): array
    {
        return $this->request('GET', '/agents/fetch-output', array_merge(['id' => $id], $params));
    }

    /**
     * List containers associated with an agent.
     *
     * @param  string  $agentId  Agent ID.
     * @param  array<string, mixed>  $params  Filters such as beforeEndedAt, limit, mode, and withRuntimeEvents.
     * @return array<string, mixed>
     */
    public function listContainers(string $agentId, array $params = []): array
    {
        return $this->request('GET', '/containers/fetch-all', array_merge(['agentId' => $agentId], $params));
    }

    /**
     * Get a single container by ID.
     *
     * @param  string  $id  Container ID.
     * @param  array<string, mixed>  $params  Include flags such as withResultObject, withOutput, withRuntimeEvents, and withNewerAndOlderContainerId.
     * @return array<string, mixed>
     */
    public function getContainer(string $id, array $params = []): array
    {
        return $this->request('GET', '/containers/fetch', array_merge(['id' => $id], $params));
    }

    /**
     * Fetch container output as JSON or raw text.
     *
     * @param  string  $id  Container ID.
     * @param  string|null  $mode  Output mode: json or raw.
     * @return array<string, mixed>
     */
    public function fetchContainerOutput(string $id, ?string $mode = null): array
    {
        return $this->request('GET', '/containers/fetch-output', array_filter([
            'id' => $id,
            'mode' => $mode,
        ], static fn ($value): bool => $value !== null && $value !== ''));
    }

    /**
     * Fetch the result object associated with a container.
     *
     * @param  string  $id  Container ID.
     * @return array<string, mixed>
     */
    public function fetchContainerResultObject(string $id): array
    {
        return $this->request('GET', '/containers/fetch-result-object', ['id' => $id]);
    }

    /**
     * List scripts available to the current user.
     *
     * @return array<string, mixed>
     */
    public function listScripts(): array
    {
        return $this->request('GET', '/scripts/fetch-all');
    }

    /**
     * Get a script by ID.
     *
     * @param  string  $id  Script ID.
     * @return array<string, mixed>
     */
    public function getScript(string $id): array
    {
        return $this->request('GET', '/scripts/fetch', ['id' => $id]);
    }

    /**
     * Create or update a script.
     *
     * @param  array<string, mixed>  $payload  Script upsert payload.
     * @return array<string, mixed>
     */
    public function saveScript(array $payload): array
    {
        return $this->request('POST', '/scripts/save', $payload);
    }

    /**
     * Delete a script.
     *
     * @param  string  $id  Script ID.
     * @return array<string, mixed>
     */
    public function deleteScript(string $id): array
    {
        return $this->request('POST', '/scripts/delete', ['id' => $id]);
    }

    /**
     * List branches in the current organization.
     *
     * @return array<string, mixed>
     */
    public function listBranches(): array
    {
        return $this->request('GET', '/branches/fetch-all');
    }

    /**
     * Fetch the current organization.
     *
     * @param  array<string, mixed>  $params  Include flags such as withGlobalObject, withProxies, withCrmIntegrations, and withCustomPrompts.
     * @return array<string, mixed>
     */
    public function getOrganization(array $params = []): array
    {
        return $this->request('GET', '/orgs/fetch', $params);
    }

    /**
     * Resolve the country for an IP address.
     *
     * @param  string  $ip  IPv4 or IPv6 address.
     * @return array<string, mixed>
     */
    public function getIpLocation(string $ip): array
    {
        return $this->request('GET', '/location/ip', ['ip' => $ip]);
    }

    /**
     * Send a GET request to a relative Phantombuster API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Phantombuster API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative Phantombuster API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Phantombuster API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  Optional JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? ($response->body() === '' ? [] : ['body' => $response->body()]);
    }

    /**
     * Make a raw HTTP request to the Phantombuster API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Phantombuster API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Phantombuster-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Phantombuster API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Phantombuster API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Phantombuster API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Phantombuster API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Phantombuster API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Phantombuster API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize and validate caller-supplied relative API paths.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Phantombuster API path must be relative, such as /agents/fetch-all.');
        }

        return str_starts_with($path, '/') ? $path : '/' . $path;
    }
}
