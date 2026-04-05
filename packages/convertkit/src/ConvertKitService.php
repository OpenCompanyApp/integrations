<?php

namespace OpenCompany\Integrations\ConvertKit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * ConvertKit API service for interacting with the ConvertKit v3 REST API.
 *
 * Handles authentication via API key query parameter, HTTP requests,
 * error handling, and response parsing for all ConvertKit endpoints.
 */
class ConvertKitService
{
    /**
     * Create a new ConvertKitService instance.
     *
     * @param  string  $apiKey  ConvertKit API key
     * @param  string  $baseUrl  Base URL for the ConvertKit API
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.convertkit.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the ConvertKit account information.
     *
     * Used for testing the connection and verifying API credentials.
     *
     * @return array<string, mixed> Account data from the ConvertKit API
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * List subscribers with pagination and sorting.
     *
     * @param  int  $page  Page number (starts at 1)
     * @param  int  $perPage  Number of results per page (max 50)
     * @param  string  $sortOrder  Sort direction: "asc" or "desc"
     * @return array<string, mixed> Paginated subscriber results
     */
    public function listSubscribers(int $page = 1, int $perPage = 50, string $sortOrder = 'desc'): array
    {
        return $this->request('GET', '/subscribers', [
            'page' => $page,
            'per_page' => min($perPage, 50),
            'sort_order' => $sortOrder,
        ]);
    }

    /**
     * Get a single subscriber by their ConvertKit subscriber ID.
     *
     * @param  int  $subscriberId  The ConvertKit subscriber ID
     * @return array<string, mixed> Subscriber data
     */
    public function getSubscriber(int $subscriberId): array
    {
        return $this->request('GET', '/subscribers/' . $subscriberId);
    }

    /**
     * Create or update a subscriber by email address.
     *
     * @param  string  $email  Subscriber email address
     * @param  string|null  $firstName  Optional first name
     * @param  array<string, mixed>  $fields  Optional custom field values
     * @return array<string, mixed> Created/updated subscriber data
     */
    public function createSubscriber(string $email, ?string $firstName = null, array $fields = []): array
    {
        $data = ['email' => $email];

        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }

        if (!empty($fields)) {
            $data['fields'] = $fields;
        }

        return $this->request('POST', '/subscribers', $data);
    }

    /**
     * List all tags in the account.
     *
     * @return array<string, mixed> List of tags
     */
    public function listTags(): array
    {
        return $this->request('GET', '/tags');
    }

    /**
     * Create a new tag.
     *
     * @param  string  $name  The tag name
     * @return array<string, mixed> Created tag data
     */
    public function createTag(string $name): array
    {
        return $this->request('POST', '/tags', [
            'tag' => ['name' => $name],
        ]);
    }

    /**
     * Tag a subscriber by subscribing them to a tag.
     *
     * @param  int  $tagId  The tag ID
     * @param  string  $email  Subscriber email address
     * @param  string|null  $firstName  Optional first name
     * @return array<string, mixed> Subscription result
     */
    public function tagSubscriber(int $tagId, string $email, ?string $firstName = null): array
    {
        $data = ['email' => $email];

        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }

        return $this->request('POST', '/tags/' . $tagId . '/subscribe', $data);
    }

    /**
     * Remove a tag from a subscriber by unsubscribing them from the tag.
     *
     * @param  int  $tagId  The tag ID
     * @param  string  $email  Subscriber email address
     * @return array<string, mixed> Unsubscription result
     */
    public function untagSubscriber(int $tagId, string $email): array
    {
        return $this->request('POST', '/tags/' . $tagId . '/unsubscribe', [
            'email' => $email,
        ]);
    }

    /**
     * List all forms in the account.
     *
     * @return array<string, mixed> List of forms
     */
    public function listForms(): array
    {
        return $this->request('GET', '/forms');
    }

    /**
     * Subscribe an email address to a form.
     *
     * @param  int  $formId  The form ID
     * @param  string  $email  Subscriber email address
     * @param  string|null  $firstName  Optional first name
     * @return array<string, mixed> Subscription result
     */
    public function subscribeToForm(int $formId, string $email, ?string $firstName = null): array
    {
        $data = ['email' => $email];

        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }

        return $this->request('POST', '/forms/' . $formId . '/subscribe', $data);
    }

    /**
     * List all sequences (courses) in the account.
     *
     * @return array<string, mixed> List of sequences
     */
    public function listSequences(): array
    {
        return $this->request('GET', '/sequences');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path (relative to base URL)
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST)
     * @return array<string, mixed> Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ConvertKit API.
     *
     * Attaches the API key as a query parameter on every request.
     * Handles error responses, HTML bodies, and connection failures.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request payload
     * @return \Illuminate\Http\Client\Response Raw HTTP response
     *
     * @throws \RuntimeException On auth, connection, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('ConvertKit API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, array_merge($data, ['api_key' => $this->apiKey])),
                'POST' => $http->post($url, array_merge($data, ['api_key' => $this->apiKey])),
                'PUT' => $http->put($url, array_merge($data, ['api_key' => $this->apiKey])),
                'DELETE' => $http->delete($url, array_merge($data, ['api_key' => $this->apiKey])),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("ConvertKit API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ConvertKit API returned unexpected HTML (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ConvertKit API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ConvertKit API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ConvertKit API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ConvertKit API: {$e->getMessage()}");
        }
    }
}
