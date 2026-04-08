<?php

namespace OpenCompany\Integrations\Accelo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Accelo API service — handles authentication and HTTP requests.
 *
 * Communicates with the Accelo REST API using Bearer token authentication.
 * The base URL is constructed from the deployment name:
 * `https://{deployment}.accelo.com`
 */
class AcceloService
{
    public function __construct(
        private string $accessToken = '',
        private string $deployment = '',
        private string $baseUrl = '',
    ) {
        // Build base URL from deployment if no explicit base URL is given
        if (empty($this->baseUrl) && !empty($this->deployment)) {
            $this->baseUrl = 'https://' . $this->deployment . '.accelo.com';
        }

        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * Get the configured base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * List tickets with optional filtering and pagination.
     *
     * @param  int  $limit   Number of results per page (default 25, max 100).
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $status  Filter by ticket status (e.g. "open", "closed", "resolved").
     * @return array<string, mixed>
     */
    public function listTickets(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        $params = [
            '_limit' => $limit,
            '_page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v0/tickets', $params);
    }

    /**
     * Get a single ticket by its ID.
     *
     * @param  int  $ticketId  The Accelo ticket ID.
     * @return array<string, mixed>
     */
    public function getTicket(int $ticketId): array
    {
        return $this->request('GET', '/api/v0/tickets/' . $ticketId);
    }

    /**
     * Create a new ticket.
     *
     * @param  string  $title        Ticket title/subject.
     * @param  string  $body         Ticket description body.
     * @param  int|null  $contractId  Optional contract to associate.
     * @param  int|null  $priority    Priority level (e.g. 1–5).
     * @return array<string, mixed>
     */
    public function createTicket(string $title, string $body, ?int $contractId = null, ?int $priority = null): array
    {
        $data = [
            'title' => $title,
            'body' => $body,
        ];

        if ($contractId !== null) {
            $data['contract_id'] = $contractId;
        }

        if ($priority !== null) {
            $data['priority'] = $priority;
        }

        return $this->request('POST', '/api/v0/tickets', $data);
    }

    /**
     * List tasks with optional filtering and pagination.
     *
     * @param  int  $limit   Number of results per page (default 25, max 100).
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $status  Filter by task status.
     * @return array<string, mixed>
     */
    public function listTasks(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        $params = [
            '_limit' => $limit,
            '_page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v0/tasks', $params);
    }

    /**
     * Get a single task by its ID.
     *
     * @param  int  $taskId  The Accelo task ID.
     * @return array<string, mixed>
     */
    public function getTask(int $taskId): array
    {
        return $this->request('GET', '/api/v0/tasks/' . $taskId);
    }

    /**
     * List projects with optional filtering and pagination.
     *
     * @param  int  $limit   Number of results per page (default 25, max 100).
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $status  Filter by project status.
     * @return array<string, mixed>
     */
    public function listProjects(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        $params = [
            '_limit' => $limit,
            '_page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v0/projects', $params);
    }

    /**
     * Get the currently authenticated Accelo user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v0/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/api/v0/tickets").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Accelo API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->baseUrl) {
            throw new \RuntimeException('Accelo integration is not configured. Provide an access token and deployment.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Accelo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Accelo API endpoint not available (HTTP {$response->status()}). Check your deployment name and credentials.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Accelo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Accelo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Accelo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Accelo API: {$e->getMessage()}");
        }
    }
}
