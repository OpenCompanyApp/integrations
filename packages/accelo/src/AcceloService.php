<?php

namespace OpenCompany\Integrations\Accelo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Accelo API service for the public REST API.
 *
 * Communicates with the Accelo REST API using Bearer token authentication.
 * The base URL is constructed from the deployment name:
 * `https://{deployment}.api.accelo.com`
 */
class AcceloService
{
    /**
     * @param  string  $accessToken  Accelo OAuth access token.
     * @param  string  $deployment  Accelo deployment prefix.
     * @param  string  $baseUrl  Optional full API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $deployment = '',
        private string $baseUrl = '',
    ) {
        if (empty($this->baseUrl) && !empty($this->deployment)) {
            $this->baseUrl = 'https://' . $this->deployment . '.api.accelo.com';
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
     * List issues, also known as tickets, with optional filtering and pagination.
     *
     * @param  int  $limit   Number of results per page (default 25, max 100).
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $status  Filter by issue standing (e.g. "open", "closed", "resolved").
     * @return array<string, mixed>
     */
    public function listTickets(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        return $this->request('GET', '/api/v0/issues', $this->listParams($limit, $page, $status));
    }

    /**
     * Get a single issue, also known as a ticket, by ID.
     *
     * @param  int  $ticketId  The Accelo ticket ID.
     * @return array<string, mixed>
     */
    public function getTicket(int $ticketId): array
    {
        return $this->request('GET', '/api/v0/issues/' . $ticketId);
    }

    /**
     * Create a new issue, also known as a ticket.
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
            'description' => $body,
        ];

        if ($contractId !== null) {
            $data['contract_id'] = $contractId;
        }

        if ($priority !== null) {
            $data['priority_id'] = $priority;
        }

        return $this->request('POST', '/api/v0/issues', $data);
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
        return $this->request('GET', '/api/v0/tasks', $this->listParams($limit, $page, $status));
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
     * List projects, represented as jobs in the Accelo API.
     *
     * @param  int  $limit   Number of results per page (default 25, max 100).
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $status  Filter by project status.
     * @return array<string, mixed>
     */
    public function listProjects(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        return $this->request('GET', '/api/v0/jobs', $this->listParams($limit, $page, $status));
    }

    /**
     * Get information about the currently authenticated access token.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v0/tokeninfo');
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
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'PUT' => $http->asForm()->put($url, $data),
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

    /**
     * Build common list parameters for Accelo collection endpoints.
     *
     * @param  int  $limit  Number of results per page.
     * @param  int  $page  Page number.
     * @param  string|null  $standing  Optional standing filter.
     * @return array<string, mixed>
     */
    private function listParams(int $limit, int $page, ?string $standing = null): array
    {
        $params = [
            '_limit' => min(max($limit, 1), 100),
            '_page' => max($page, 1),
        ];

        if ($standing !== null && $standing !== '') {
            $params['_filters'] = 'standing(' . $standing . ')';
        }

        return $params;
    }
}
