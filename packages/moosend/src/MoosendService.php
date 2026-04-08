<?php

namespace OpenCompany\Integrations\Moosend;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MoosendService
{
    /**
     * The Moosend API key used for authentication via query parameter.
     */
    private string $apiKey;

    /**
     * The base URL for the Moosend v3 API.
     */
    private string $baseUrl;

    /**
     * Create a new MoosendService instance.
     *
     * @param string $apiKey  The Moosend API key.
     * @param string $baseUrl The base URL for the Moosend API (default: https://api.moosend.com/v3).
     */
    public function __construct(
        string $apiKey = '',
        string $baseUrl = 'https://api.moosend.com/v3',
    ) {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Determine whether the service is configured with an API key.
     *
     * @return bool True if an API key is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all mailing lists.
     *
     * @param int $limit  Maximum number of lists to return (default: 10).
     * @param int $offset Offset for pagination (default: 0).
     * @return array The API response containing mailing lists.
     */
    public function listMailingLists(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/lists.json', [
            'Limit' => $limit,
            'Offset' => $offset,
        ]);
    }

    /**
     * Get details for a specific mailing list.
     *
     * @param string $id The mailing list ID.
     * @return array The API response containing mailing list details.
     */
    public function getMailingList(string $id): array
    {
        return $this->request('GET', "/lists/{$id}/details.json");
    }

    /**
     * Create a new mailing list.
     *
     * @param string $name The name of the new mailing list (required).
     * @return array The API response containing the created mailing list.
     */
    public function createMailingList(string $name): array
    {
        return $this->request('POST', '/lists/create.json', [], [
            'Name' => $name,
        ]);
    }

    /**
     * List subscribers for a specific mailing list.
     *
     * @param string $listId The mailing list ID (required).
     * @param int    $limit  Maximum number of subscribers to return (default: 10).
     * @param int    $page   Page number for pagination (default: 1).
     * @param string $status Filter by subscriber status (e.g., "Subscribed", "Unsubscribed", "Bounced", "Removed").
     * @return array The API response containing subscribers.
     */
    public function listSubscribers(string $listId, int $limit = 10, int $page = 1, string $status = ''): array
    {
        $params = [
            'Limit' => $limit,
            'Page' => $page,
        ];

        if (!empty($status)) {
            $params['Status'] = $status;
        }

        return $this->request('GET', "/lists/{$listId}/subscribers.json", $params);
    }

    /**
     * Add a subscriber to a mailing list.
     *
     * @param string $listId The mailing list ID (required).
     * @param string $email  The subscriber's email address (required).
     * @param string $name   The subscriber's name (optional).
     * @return array The API response containing the added subscriber.
     */
    public function addSubscriber(string $listId, string $email, string $name = ''): array
    {
        $body = [
            'Email' => $email,
        ];

        if (!empty($name)) {
            $body['Name'] = $name;
        }

        return $this->request('POST', "/lists/{$listId}/subscribers.json", [], $body);
    }

    /**
     * List all campaigns.
     *
     * @param int    $limit  Maximum number of campaigns to return (default: 10).
     * @param int    $page   Page number for pagination (default: 1).
     * @param string $status Filter by campaign status (e.g., "Sent", "Draft", "Scheduled", "Sending").
     * @return array The API response containing campaigns.
     */
    public function listCampaigns(int $limit = 10, int $page = 1, string $status = ''): array
    {
        $params = [
            'Limit' => $limit,
            'Page' => $page,
        ];

        if (!empty($status)) {
            $params['Status'] = $status;
        }

        return $this->request('GET', '/campaigns.json', $params);
    }

    /**
     * Get the current authenticated user (health check).
     *
     * @return array The API response containing user details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me.json');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method   The HTTP method (GET, POST, PUT, DELETE).
     * @param string $path     The API endpoint path.
     * @param array  $query    Query parameters to append to the URL.
     * @param array  $body     Request body for POST/PUT requests.
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Moosend API.
     *
     * Authentication is handled via the `apikey` query parameter (NOT Bearer token).
     * The API key is automatically appended to every request URL.
     *
     * @param string $method   The HTTP method (GET, POST, PUT, DELETE).
     * @param string $path     The API endpoint path.
     * @param array  $query    Query parameters to append to the URL.
     * @param array  $body     Request body for POST/PUT requests.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Moosend API key is not configured.');
        }

        // Build URL with apikey as the first query parameter
        $url = $this->baseUrl . $path . '?apikey=' . urlencode($this->apiKey);

        // Append additional query parameters
        if (!empty($query)) {
            foreach ($query as $key => $value) {
                $url .= '&' . urlencode($key) . '=' . urlencode((string) $value);
            }
        }

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $errorData = $response->json();
                $error = $errorData['Error'] ?? $errorData['error'] ?? $response->body();

                Log::error("Moosend API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Moosend API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Moosend API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Moosend API: {$e->getMessage()}");
        }
    }
}
