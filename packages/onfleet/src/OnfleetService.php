<?php

namespace OpenCompany\Integrations\Onfleet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OnfleetService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://onfleet.com/api/v2',
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

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $query  Query parameters (e.g., state, worker, organization, completeBeforeAfter, etc.)
     * @return array<string, mixed>
     */
    public function listTasks(array $query = []): array
    {
        return $this->request('GET', '/tasks', $query);
    }

    /**
     * Get a single task by ID.
     *
     * @return array<string, mixed>
     */
    public function getTask(string $taskId): array
    {
        return $this->request('GET', '/tasks/' . urlencode($taskId));
    }

    /**
     * Create a new task.
     *
     * @param  array<string, mixed>  $data  Task creation payload.
     * @return array<string, mixed>
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
    }

    /**
     * Update an existing task.
     *
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateTask(string $taskId, array $data): array
    {
        return $this->request('PUT', '/tasks/' . urlencode($taskId), $data);
    }

    /**
     * Delete a task by ID.
     */
    public function deleteTask(string $taskId): void
    {
        $this->request('DELETE', '/tasks/' . urlencode($taskId));
    }

    /**
     * List all workers.
     *
     * @param  array<string, mixed>  $query  Optional query parameters (e.g., teams, states).
     * @return array<string, mixed>
     */
    public function listWorkers(array $query = []): array
    {
        return $this->request('GET', '/workers', $query);
    }

    /**
     * List all teams.
     *
     * @return array<string, mixed>
     */
    public function listTeams(): array
    {
        return $this->request('GET', '/teams');
    }

    /**
     * List recipients.
     *
     * @param  array<string, mixed>  $query  Optional query parameters (e.g., name, phone, email).
     * @return array<string, mixed>
     */
    public function listRecipients(array $query = []): array
    {
        return $this->request('GET', '/recipients', $query);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/auth');
    }

    /**
     * Make an API request and return parsed JSON.
     *
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
     * Make a raw HTTP request to the Onfleet API using HTTP Basic auth.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Onfleet API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, '')
              ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Onfleet API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Onfleet API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Onfleet API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("Onfleet API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Onfleet API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Onfleet API: {$e->getMessage()}");
        }
    }
}
