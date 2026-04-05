<?php

namespace OpenCompany\Integrations\Sendy;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendyService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Sendy service is configured with an API key and base URL.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    /**
     * Subscribe an email address to a list.
     *
     * @param  string  $list  The list ID to subscribe to.
     * @param  string  $email  The subscriber's email address.
     * @param  string|null  $name  The subscriber's name (optional).
     * @param  array<string, mixed>  $customFields  Additional custom fields to pass.
     * @return array{status: string, message: string}
     */
    public function subscribe(string $list, string $email, ?string $name = null, array $customFields = []): array
    {
        $data = array_merge([
            'list' => $list,
            'email' => $email,
            'boolean' => 'true',
        ], $customFields);

        if ($name !== null) {
            $data['name'] = $name;
        }

        $response = $this->rawRequest('POST', '/subscribe', $data);
        $body = trim($response->body());

        return $this->parseSubscribeResponse($body);
    }

    /**
     * Unsubscribe an email address from a list.
     *
     * @param  string  $list  The list ID to unsubscribe from.
     * @param  string  $email  The subscriber's email address.
     * @return array{status: string, message: string}
     */
    public function unsubscribe(string $list, string $email): array
    {
        $response = $this->rawRequest('POST', '/unsubscribe', [
            'list' => $list,
            'email' => $email,
            'boolean' => 'true',
        ]);

        $body = trim($response->body());

        return match ($body) {
            '1' => ['status' => 'success', 'message' => 'Unsubscribed successfully.'],
            default => ['status' => 'error', 'message' => $body ?: 'Unknown error.'],
        };
    }

    /**
     * Get the subscriber count for a list.
     *
     * @param  string  $listId  The list ID to query.
     * @return int
     */
    public function listSubscribers(string $listId): int
    {
        $response = $this->rawRequest('GET', '/api/subscribers.php', [
            'list_id' => $listId,
        ]);

        $body = trim($response->body());

        if (!is_numeric($body)) {
            throw new \RuntimeException('Unexpected response from subscribers endpoint: ' . $body);
        }

        return (int) $body;
    }

    /**
     * Create a new campaign in Sendy.
     *
     * @param  array<string, mixed>  $params  Campaign parameters (from_name, from_email, reply_to, title, subject, html_text, plain_text, list_ids, etc.).
     * @return array{status: string, message: string, campaign_id?: string}
     */
    public function createCampaign(array $params): array
    {
        $response = $this->rawRequest('POST', '/api/campaigns.php', $params);
        $body = trim($response->body());

        // Sendy returns the campaign ID on success or an error message
        if (str_starts_with($body, 'Campaign')) {
            return ['status' => 'success', 'message' => $body];
        }

        // Try to extract a campaign ID (numeric response)
        if (is_numeric($body)) {
            return ['status' => 'success', 'message' => 'Campaign created.', 'campaign_id' => $body];
        }

        return ['status' => 'error', 'message' => $body ?: 'Unknown error creating campaign.'];
    }

    /**
     * Get the current brand/user information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/brands.php', []);
    }

    /**
     * Parse the subscribe endpoint response.
     *
     * @param  string  $body  Raw response body.
     * @return array{status: string, message: string}
     */
    private function parseSubscribeResponse(string $body): array
    {
        return match ($body) {
            '1' => ['status' => 'success', 'message' => 'Subscribed successfully.'],
            'Already subscribed.' => ['status' => 'success', 'message' => 'Already subscribed.'],
            'Invalid email address.' => ['status' => 'error', 'message' => 'Invalid email address.'],
            'Email is suppressed.' => ['status' => 'error', 'message' => 'Email is suppressed.'],
            'List does not exist.' => ['status' => 'error', 'message' => 'List does not exist.'],
            'Some fields are missing.' => ['status' => 'error', 'message' => 'Some required fields are missing.'],
            'Invalid list ID.' => ['status' => 'error', 'message' => 'Invalid list ID.'],
            default => ['status' => 'error', 'message' => $body ?: 'Unknown error.'],
        };
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = trim($response->body());

        // Try JSON first
        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        // Return raw body as a simple message
        return ['message' => $body];
    }

    /**
     * Make a raw HTTP request to the Sendy API.
     *
     * Auth is sent as form parameters (api_key) rather than HTTP headers.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->baseUrl) {
            throw new \RuntimeException('Sendy API key or hostname is not configured.');
        }

        $url = $this->baseUrl . $path;

        // Sendy uses form params with api_key for authentication
        $data['api_key'] = $this->apiKey;

        try {
            $http = Http::asForm()->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Sendy API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Sendy API endpoint not available (HTTP {$response->status()}). Check the hostname is correct.");
                }

                Log::error("Sendy API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $body,
                ]);
                throw new \RuntimeException("Sendy API error ({$response->status()}): {$body}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Sendy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Sendy API: {$e->getMessage()}");
        }
    }
}
