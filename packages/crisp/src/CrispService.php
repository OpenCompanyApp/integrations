<?php

namespace OpenCompany\Integrations\Crisp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * CrispService — HTTP client for the Crisp Chat API.
 *
 * Authenticates via HTTP Basic using the API key as the username
 * and the website ID as the password.
 *
 * @see https://docs.crisp.chat/guides/rest-api/rate-limiting/
 */
class CrispService
{
    public function __construct(
        private string $apiKey = '',
        private string $websiteId = '',
        private string $baseUrl = 'https://api.crisp.chat/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has enough credentials to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->websiteId);
    }

    /**
     * Get the configured website ID.
     */
    public function getWebsiteId(): string
    {
        return $this->websiteId;
    }

    /**
     * List conversations for the website.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Number of conversations per page.
     * @return array<string, mixed>
     */
    public function listConversations(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', "/website/{$this->websiteId}/conversations", [
            'page_number' => $page,
            'page_size' => $perPage,
        ]);
    }

    /**
     * Get a single conversation by ID.
     *
     * @param  string  $conversationId  The conversation session ID.
     * @return array<string, mixed>
     */
    public function getConversation(string $conversationId): array
    {
        return $this->request('GET', "/website/{$this->websiteId}/conversations/{$conversationId}");
    }

    /**
     * Send a message in a conversation.
     *
     * @param  string  $conversationId  The conversation session ID.
     * @param  string  $text  The message text.
     * @param  string  $type  Message type (text, note, file, etc.).
     * @param  string  $from  Message origin: user or operator.
     * @return array<string, mixed>
     */
    public function sendMessage(string $conversationId, string $text, string $type = 'text', string $from = 'operator'): array
    {
        return $this->request('POST', "/website/{$this->websiteId}/conversations/{$conversationId}/messages", [
            'type' => $type,
            'from' => $from,
            'content' => $text,
            'origin' => 'chat',
        ]);
    }

    /**
     * List contacts for the website.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Number of contacts per page.
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', "/website/{$this->websiteId}/contacts", [
            'page_number' => $page,
            'page_size' => $perPage,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $contactId  The contact identifier.
     * @return array<string, mixed>
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', "/website/{$this->websiteId}/contacts/{$contactId}");
    }

    /**
     * List campaigns for the website.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Number of campaigns per page.
     * @return array<string, mixed>
     */
    public function listCampaigns(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', "/website/{$this->websiteId}/campaigns", [
            'page_number' => $page,
            'page_size' => $perPage,
        ]);
    }

    /**
     * Get the currently authenticated user profile.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Crisp API.
     *
     * Uses HTTP Basic authentication with apiKey as username and websiteId as password.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->websiteId) {
            throw new \RuntimeException('Crisp API key and Website ID are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, $this->websiteId)
              ->timeout(30);

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
                    Log::warning("Crisp API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Crisp API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or credentials may be invalid.");
                }

                $error = $response->json('reason') ?? $response->json('message') ?? $body;
                Log::error("Crisp API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Crisp API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Crisp API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Crisp API: {$e->getMessage()}");
        }
    }
}
