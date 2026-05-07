<?php

namespace OpenCompany\Integrations\Sendy;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for a self-hosted Sendy installation.
 *
 * Sendy authenticates with an `api_key` form field and returns a mix of plain-text
 * and JSON responses, so service methods normalize common success and error shapes.
 */
class SendyService
{
    /**
     * @param  string  $apiKey  Sendy API key from Settings
     * @param  string  $baseUrl  Base URL of the Sendy installation
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    /**
     * Subscribe or update an email address on a list.
     *
     * @param  string  $list  Encrypted list ID
     * @param  string  $email  Subscriber email address
     * @param  string|null  $name  Optional subscriber name
     * @param  array<string, mixed>  $customFields  Optional Sendy fields such as country, referrer, gdpr, silent, hp, or custom field tags
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

        return $this->parseBooleanResponse(trim($this->rawRequest('POST', '/subscribe', $data)->body()), 'Subscribed successfully.');
    }

    /**
     * Unsubscribe an email address from a list.
     *
     * @param  string  $list  Encrypted list ID
     * @param  string  $email  Subscriber email address
     * @return array{status: string, message: string}
     */
    public function unsubscribe(string $list, string $email): array
    {
        return $this->parseBooleanResponse(trim($this->rawRequest('POST', '/unsubscribe', [
            'list' => $list,
            'email' => $email,
            'boolean' => 'true',
        ])->body()), 'Unsubscribed successfully.');
    }

    /**
     * Delete a subscriber from a list.
     *
     * @param  string  $listId  Encrypted list ID
     * @param  string  $email  Subscriber email address
     * @return array{status: string, message: string}
     */
    public function deleteSubscriber(string $listId, string $email): array
    {
        return $this->parseBooleanResponse(trim($this->rawRequest('POST', '/api/subscribers/delete.php', [
            'list_id' => $listId,
            'email' => $email,
        ])->body()), 'Subscriber deleted successfully.');
    }

    /**
     * Get a subscriber's status in a list.
     *
     * @param  string  $listId  Encrypted list ID
     * @param  string  $email  Subscriber email address
     * @return array{status: string, email: string, list_id: string}
     */
    public function getSubscriptionStatus(string $listId, string $email): array
    {
        $body = trim($this->rawRequest('POST', '/api/subscribers/subscription-status.php', [
            'list_id' => $listId,
            'email' => $email,
        ])->body());

        $errors = ['No data passed', 'API key not passed', 'Invalid API key', 'Email not passed', 'List ID not passed', 'Email does not exist in list'];
        if (in_array($body, $errors, true)) {
            throw new RuntimeException($body);
        }

        return [
            'status' => $body,
            'email' => $email,
            'list_id' => $listId,
        ];
    }

    /**
     * Get the active subscriber count for a list.
     *
     * @param  string  $listId  Encrypted list ID
     * @return int
     */
    public function activeSubscriberCount(string $listId): int
    {
        $body = trim($this->rawRequest('POST', '/api/subscribers/active-subscriber-count.php', [
            'list_id' => $listId,
        ])->body());

        if (! is_numeric($body)) {
            throw new RuntimeException('Unexpected response from active subscriber count endpoint: ' . $body);
        }

        return (int) $body;
    }

    /**
     * Backward-compatible alias for active subscriber count.
     *
     * @param  string  $listId  Encrypted list ID
     */
    public function listSubscribers(string $listId): int
    {
        return $this->activeSubscriberCount($listId);
    }

    /**
     * Get lists for a brand.
     *
     * @param  string  $brandId  Brand ID from the Brands page
     * @param  bool  $includeHidden  Include hidden lists when true
     * @return array<string, mixed>
     */
    public function getLists(string $brandId, bool $includeHidden = false): array
    {
        return $this->request('POST', '/api/lists/get-lists.php', [
            'brand_id' => $brandId,
            'include_hidden' => $includeHidden ? 'yes' : 'no',
        ]);
    }

    /**
     * Get all brands visible to the API key.
     *
     * @return array<string, mixed>
     */
    public function getBrands(): array
    {
        return $this->request('POST', '/api/brands/get-brands.php');
    }

    /**
     * Backward-compatible alias for the previous current-user tool.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->getBrands();
    }

    /**
     * Create, send, or schedule a campaign.
     *
     * @param  array<string, mixed>  $params  Campaign parameters documented by Sendy
     * @return array{status: string, message: string}
     */
    public function createCampaign(array $params): array
    {
        $body = trim($this->rawRequest('POST', '/api/campaigns/create.php', $params)->body());

        return match ($body) {
            'Campaign created', 'Campaign created and now sending', 'Campaign scheduled' => ['status' => 'success', 'message' => $body],
            default => ['status' => 'error', 'message' => $body ?: 'Unknown error creating campaign.'],
        };
    }

    /**
     * Make an API request and return parsed JSON or raw message.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Form parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw Sendy HTTP request.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Form parameters
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '' || $this->baseUrl === '') {
            throw new RuntimeException('Sendy API key or hostname is not configured.');
        }

        $url = $this->baseUrl . $path;
        $data['api_key'] = $this->apiKey;

        try {
            $http = Http::asForm()->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Sendy API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Sendy API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize Sendy's plain-text boolean responses.
     *
     * @return array{status: string, message: string}
     */
    private function parseBooleanResponse(string $body, string $successMessage): array
    {
        return match ($body) {
            '1', 'true' => ['status' => 'success', 'message' => $successMessage],
            'Already subscribed.' => ['status' => 'success', 'message' => 'Already subscribed.'],
            default => ['status' => 'error', 'message' => $body ?: 'Unknown error.'],
        };
    }

    /**
     * Log and throw a normalized API error.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Sendy API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("Sendy API endpoint not available (HTTP {$response->status()}). Check the hostname is correct.");
        }

        Log::error("Sendy API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $body,
        ]);

        throw new RuntimeException("Sendy API error ({$response->status()}): {$body}");
    }
}
