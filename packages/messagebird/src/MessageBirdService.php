<?php

namespace OpenCompany\Integrations\MessageBird;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MessageBirdService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.messagebird.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send an SMS message.
     *
     * @param  string  $originator  Sender name or phone number (e.g., "OpenCompany" or "+3197012345678").
     * @param  array<int, string>  $recipients  List of recipient phone numbers in international format.
     * @param  string  $body  The message text (max 160 chars for single SMS, longer messages are concatenated).
     * @return array<string, mixed> The API response containing message details.
     */
    public function sendSms(string $originator, array $recipients, string $body): array
    {
        return $this->request('POST', '/messages', [
            'originator' => $originator,
            'recipients' => $recipients,
            'body' => $body,
        ]);
    }

    /**
     * Get a message by its ID.
     *
     * @param  string  $id  The message ID returned by the API.
     * @return array<string, mixed> The message details.
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/messages/' . urlencode($id));
    }

    /**
     * List messages with optional filters.
     *
     * @param  int  $limit  Maximum number of messages to return (default: 20, max: 1000).
     * @param  int  $offset  Offset for pagination.
     * @param  string|null  $status  Filter by status: scheduled, sent, buffered, delivered, expired, delivery_failed.
     * @param  string|null  $direction  Filter by direction: mt (mobile terminated), mo (mobile originated).
     * @return array<string, mixed> The paginated list of messages.
     */
    public function listMessages(int $limit = 20, int $offset = 0, ?string $status = null, ?string $direction = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($direction !== null) {
            $params['direction'] = $direction;
        }

        return $this->request('GET', '/messages', $params);
    }

    /**
     * Get the current account balance.
     *
     * @return array<string, mixed> The balance details including amount and type.
     */
    public function listBalance(): array
    {
        return $this->request('GET', '/balance');
    }

    /**
     * List purchased phone numbers with optional filters.
     *
     * @param  int  $limit  Maximum number of numbers to return.
     * @param  int  $offset  Offset for pagination.
     * @param  string|null  $countryCode  Filter by ISO 3166-1 alpha-2 country code (e.g., "NL", "US").
     * @param  string|null  $numberType  Filter by type: mobile, landline.
     * @return array<string, mixed> The paginated list of numbers.
     */
    public function listNumbers(int $limit = 20, int $offset = 0, ?string $countryCode = null, ?string $numberType = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($countryCode !== null) {
            $params['country_code'] = $countryCode;
        }

        if ($numberType !== null) {
            $params['number_type'] = $numberType;
        }

        return $this->request('GET', '/numbers', $params);
    }

    /**
     * Get the current authenticated user / account info.
     *
     * Alias for listBalance() which returns account-level information.
     *
     * @return array<string, mixed> The account / balance details.
     */
    public function getCurrentUser(): array
    {
        return $this->listBalance();
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/messages").
     * @param  array<string, mixed>  $data  Request body (POST/PUT) or query params (GET).
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MessageBird API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/messages").
     * @param  array<string, mixed>  $data  Request body (POST/PUT) or query params (GET).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('MessageBird API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Access-Key ' . $this->apiKey,
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
                    Log::warning("MessageBird API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("MessageBird API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('errors') ?? $body;
                $errorMessage = is_array($error)
                    ? collect($error)->pluck('description')->join('; ')
                    : (is_string($error) ? $error : json_encode($error));

                Log::error("MessageBird API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MessageBird API error ({$response->status()}): {$errorMessage}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MessageBird API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MessageBird API: {$e->getMessage()}");
        }
    }
}
