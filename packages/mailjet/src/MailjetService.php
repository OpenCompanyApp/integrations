<?php

namespace OpenCompany\Integrations\Mailjet;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailjetService
{
    public function __construct(
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $baseUrl = 'https://api.mailjet.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Mailjet API credentials are configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->apiSecret);
    }

    /**
     * Send an email through the Mailjet Send API.
     *
     * @param  array{From: array{Email: string, Name?: string}, To: array<int, array{Email: string, Name?: string}>, Subject: string, HTML?: string, Text?: string}  $payload
     * @return array<string, mixed>
     */
    public function sendEmail(array $payload): array
    {
        return $this->request('POST', '/send', $payload);
    }

    /**
     * List contacts from the Mailjet account.
     *
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/contacts', [
            'Limit' => $limit,
            'Offset' => $offset,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(int|string $id): array
    {
        return $this->request('GET', '/contacts/' . urlencode((string) $id));
    }

    /**
     * Create a new contact.
     *
     * @return array<string, mixed>
     */
    public function createContact(string $email): array
    {
        return $this->request('POST', '/contacts', [
            'Email' => $email,
        ]);
    }

    /**
     * List campaigns from the Mailjet account.
     *
     * @return array<string, mixed>
     */
    public function listCampaigns(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/campaigns', [
            'Limit' => $limit,
            'Offset' => $offset,
        ]);
    }

    /**
     * Get a single campaign by ID.
     *
     * @return array<string, mixed>
     */
    public function getCampaign(int|string $id): array
    {
        return $this->request('GET', '/campaigns/' . urlencode((string) $id));
    }

    /**
     * List email templates.
     *
     * @return array<string, mixed>
     */
    public function listTemplates(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/template', [
            'Limit' => $limit,
            'Offset' => $offset,
        ]);
    }

    /**
     * Get statistics from the statcounters endpoint.
     *
     * @return array<string, mixed>
     */
    public function getStats(array $params = []): array
    {
        return $this->request('GET', '/statcounters', $params);
    }

    /**
     * Get the current authenticated user information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Mailjet API using HTTP Basic Auth.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey || !$this->apiSecret) {
            throw new \RuntimeException('Mailjet API key and secret are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, $this->apiSecret)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('ErrorMessage') ?? $response->body();

                Log::error("Mailjet API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Mailjet API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mailjet API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mailjet API: {$e->getMessage()}");
        }
    }
}
