<?php

namespace OpenCompany\Integrations\Novu;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovuService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.novu.co',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List notifications with optional filtering.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of items per page.
     * @param  string|null  $channel  Filter by channel (e.g., "in_app", "email", "sms", "chat", "push").
     * @return array<string, mixed>
     */
    public function listNotifications(int $page = 1, int $limit = 10, ?string $channel = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($channel !== null) {
            $params['channel'] = $channel;
        }

        return $this->request('GET', '/v1/notifications', $params);
    }

    /**
     * Get a single notification by ID.
     *
     * @param  string  $id  The notification ID.
     * @return array<string, mixed>
     */
    public function getNotification(string $id): array
    {
        return $this->request('GET', '/v1/notifications/' . urlencode($id));
    }

    /**
     * List subscribers with pagination.
     *
     * @param  int  $page  Page number (0-based).
     * @param  int  $limit  Number of items per page.
     * @return array<string, mixed>
     */
    public function listSubscribers(int $page = 0, int $limit = 10): array
    {
        return $this->request('GET', '/v1/subscribers', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single subscriber by ID.
     *
     * @param  string  $id  The subscriber ID.
     * @return array<string, mixed>
     */
    public function getSubscriber(string $id): array
    {
        return $this->request('GET', '/v1/subscribers/' . urlencode($id));
    }

    /**
     * Create a new subscriber.
     *
     * @param  string  $email  Subscriber email address.
     * @param  string|null  $firstName  Optional first name.
     * @param  string|null  $lastName  Optional last name.
     * @param  string|null  $phone  Optional phone number.
     * @return array<string, mixed>
     */
    public function createSubscriber(
        string $email,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $phone = null,
    ): array {
        $data = ['email' => $email];

        if ($firstName !== null) {
            $data['firstName'] = $firstName;
        }
        if ($lastName !== null) {
            $data['lastName'] = $lastName;
        }
        if ($phone !== null) {
            $data['phone'] = $phone;
        }

        return $this->request('POST', '/v1/subscribers', $data);
    }

    /**
     * Trigger a notification event.
     *
     * @param  string  $name  The event trigger name (template name/identifier).
     * @param  string|array  $to  Subscriber ID, email, or array of recipient identifiers.
     * @param  array<string, mixed>  $payload  Payload data to pass to the template.
     * @return array<string, mixed>
     */
    public function triggerEvent(string $name, string|array $to, array $payload = []): array
    {
        $data = [
            'name' => $name,
            'to' => $to,
            'payload' => $payload,
        ];

        return $this->request('POST', '/v1/events/trigger', $data);
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
     * @param  string  $path  API path (e.g., "/v1/notifications").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Novu API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Novu API key is not configured.');
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
                    Log::warning("Novu API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Novu API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Novu API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Novu API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Novu API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Novu API: {$e->getMessage()}");
        }
    }
}
