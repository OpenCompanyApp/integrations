<?php

namespace OpenCompany\Integrations\Courier;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CourierService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.courier.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send a message through Courier.
     *
     * @param  array<string, mixed>  $message  The message payload (template, content, routing, etc.).
     * @param  string|array<string, mixed>|null  $recipient  A recipient user ID, email, or recipient object.
     * @return array<string, mixed>
     */
    public function sendMessage(array $message, string|array|null $recipient = null): array
    {
        $payload = $message;

        if ($recipient !== null) {
            if (is_string($recipient)) {
                $payload['to'] = $recipient;
            } else {
                $payload['to'] = $recipient;
            }
        }

        return $this->request('POST', '/send', $payload);
    }

    /**
     * List messages with optional filtering and pagination.
     *
     * @param  int|null  $limit  Maximum number of messages to return.
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @param  string|null  $status  Filter by message status (e.g. "delivered", "undelivered").
     * @return array<string, mixed>
     */
    public function listMessages(?int $limit = null, ?string $cursor = null, ?string $status = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/messages', $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  string  $id  The message ID.
     * @return array<string, mixed>
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/messages/' . urlencode($id));
    }

    /**
     * List recipients with optional pagination.
     *
     * @param  int|null  $limit  Maximum number of recipients to return.
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listRecipients(?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/recipients', $params);
    }

    /**
     * Get a single recipient by ID.
     *
     * @param  string  $id  The recipient ID.
     * @return array<string, mixed>
     */
    public function getRecipient(string $id): array
    {
        return $this->request('GET', '/recipients/' . urlencode($id));
    }

    /**
     * List notification templates with optional pagination.
     *
     * @param  int|null  $limit  Maximum number of templates to return.
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listTemplates(?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/templates', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Courier API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Courier API key is not configured.');
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
                    Log::warning("Courier API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Courier API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Courier API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Courier API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Courier API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Courier API: {$e->getMessage()}");
        }
    }
}
