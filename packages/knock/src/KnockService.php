<?php

namespace OpenCompany\Integrations\Knock;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KnockService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.knock.app',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List workflows.
     *
     * @param  int  $limit  Maximum number of workflows to return (default: 25).
     * @param  int|null  $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listWorkflows(int $limit = 25, ?int $page = null): array
    {
        $params = ['limit' => $limit];
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/v1/workflows', $params);
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
     * Trigger a workflow.
     *
     * @param  string  $id  The workflow ID to trigger.
     * @param  array  $recipients  Array of recipient identifiers.
     * @param  array<string, mixed>  $data  Payload data to pass to the workflow.
     * @param  array<string, mixed>|null  $cancellationCriteria  Cancellation criteria for the workflow run.
     * @return array<string, mixed>
     */
    public function triggerWorkflow(string $id, array $recipients, array $data = [], ?array $cancellationCriteria = null): array
    {
        $body = [
            'recipients' => $recipients,
            'data' => $data,
        ];

        if ($cancellationCriteria !== null) {
            $body['cancellation_criteria'] = $cancellationCriteria;
        }

        return $this->request('POST', '/v1/workflows/' . urlencode($id) . '/trigger', $body);
    }

    /**
     * List messages.
     *
     * @param  int  $limit  Maximum number of messages to return (default: 25).
     * @param  int|null  $page  Page number for pagination.
     * @param  string|null  $status  Filter by message status (e.g., "sent", "delivered", "undelivered").
     * @return array<string, mixed>
     */
    public function listMessages(int $limit = 25, ?int $page = null, ?string $status = null): array
    {
        $params = ['limit' => $limit];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v1/messages', $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  string  $id  The message ID.
     * @return array<string, mixed>
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/v1/messages/' . urlencode($id));
    }

    /**
     * List recipients.
     *
     * @param  int  $limit  Maximum number of recipients to return (default: 25).
     * @param  int|null  $page  Page number for pagination.
     * @return array<string, mixed>
     */
    public function listRecipients(int $limit = 25, ?int $page = null): array
    {
        $params = ['limit' => $limit];
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/v1/recipients', $params);
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
     * Make a raw HTTP request to the Knock API.
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
            throw new \RuntimeException('Knock API key is not configured.');
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
                    Log::warning("Knock API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Knock API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Knock API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Knock API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Knock API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Knock API: {$e->getMessage()}");
        }
    }
}
