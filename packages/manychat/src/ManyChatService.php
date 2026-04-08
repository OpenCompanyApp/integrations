<?php

namespace OpenCompany\Integrations\ManyChat;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ManyChatService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.manychat.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all pages (flows) in the ManyChat account.
     *
     * @return array<string, mixed>
     */
    public function listFlows(): array
    {
        return $this->request('GET', '/pages');
    }

    /**
     * Get a single page (flow) by ID.
     *
     * @return array<string, mixed>
     */
    public function getFlow(string $pageId): array
    {
        return $this->request('GET', '/pages/' . urlencode($pageId));
    }

    /**
     * Send a message via the Social messaging API.
     *
     * @param  array<string, mixed>  $message
     * @return array<string, mixed>
     */
    public function sendMessage(array $message): array
    {
        return $this->request('POST', '/social/send_message', $message);
    }

    /**
     * List all tags in the ManyChat account.
     *
     * @return array<string, mixed>
     */
    public function listTags(): array
    {
        return $this->request('GET', '/tags');
    }

    /**
     * Create a new tag in the ManyChat account.
     *
     * @return array<string, mixed>
     */
    public function createTag(string $name): array
    {
        return $this->request('POST', '/tags', [
            'name' => $name,
        ]);
    }

    /**
     * Get the currently authenticated ManyChat user info.
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
     * Make a raw HTTP request to the ManyChat API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('ManyChat API key is not configured.');
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
                    Log::warning("ManyChat API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ManyChat API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not be accessible or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ManyChat API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ManyChat API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ManyChat API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ManyChat API: {$e->getMessage()}");
        }
    }
}
