<?php

namespace OpenCompany\Integrations\CustomerIO;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerIOService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.customer.io/v1',
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
     * Identify (create or update) a customer profile.
     *
     * @param  string|int  $id  Unique customer identifier (email or internal ID).
     * @param  array{email?: string, name?: string, created_at?: int}  $attributes  Customer attributes to set.
     * @return array<string, mixed> API response data.
     */
    public function identifyCustomer(string|int $id, array $attributes = []): array
    {
        return $this->request('PUT', '/customers/' . urlencode((string) $id), $attributes);
    }

    /**
     * Track an event for a given customer.
     *
     * @param  string|int  $id  Customer identifier.
     * @param  string  $name  Event name (e.g. "purchase", "signup").
     * @param  array<string, mixed>  $data  Event data payload.
     * @return array<string, mixed> API response data.
     */
    public function trackEvent(string|int $id, string $name, array $data = []): array
    {
        return $this->request('POST', '/customers/' . urlencode((string) $id) . '/events', [
            'name' => $name,
            'data' => $data,
        ]);
    }

    /**
     * List all segments in the workspace.
     *
     * @return array<string, mixed> Segments list from the API.
     */
    public function listSegments(): array
    {
        return $this->request('GET', '/segments');
    }

    /**
     * List all campaigns in the workspace.
     *
     * @return array<string, mixed> Campaigns list from the API.
     */
    public function listCampaigns(): array
    {
        return $this->request('GET', '/campaigns');
    }

    /**
     * Get details for a specific campaign.
     *
     * @param  int  $id  Campaign ID.
     * @return array<string, mixed> Campaign details from the API.
     */
    public function getCampaign(int $id): array
    {
        return $this->request('GET', '/campaigns/' . $id);
    }

    /**
     * List all newsletters in the workspace.
     *
     * @return array<string, mixed> Newsletters list from the API.
     */
    public function listNewsletters(): array
    {
        return $this->request('GET', '/newsletters');
    }

    /**
     * Get the currently authenticated user / account information.
     *
     * @return array<string, mixed> User data from the API.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = $response->body();
        $content = trim($body);

        if ($content === '' || $content === 'null') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Customer.io API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return Response Raw HTTP response.
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Customer.io API key is not configured.');
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
                    Log::warning("Customer.io API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Customer.io API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Customer.io API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Customer.io API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Customer.io API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Customer.io API: {$e->getMessage()}");
        }
    }
}
