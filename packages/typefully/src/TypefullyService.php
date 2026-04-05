<?php

namespace OpenCompany\Integrations\Typefully;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TypefullyService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.typefully.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Typefully integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the currently authenticated Typefully user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me/');
    }

    /**
     * Create a new draft in Typefully.
     *
     * @param  string  $content  The tweet/thread content. Separate tweets with 4 newlines.
     * @param  string|null  $type  The type of draft: "tweet", "thread", or "mail".
     * @param  array<string, mixed>  $options  Additional options (schedule_date, thread_connector, etc.).
     * @return array<string, mixed>
     */
    public function createDraft(string $content, ?string $type = null, array $options = []): array
    {
        $data = array_merge(['content' => $content], $options);

        if ($type !== null) {
            $data['type'] = $type;
        }

        return $this->request('POST', '/drafts/', $data);
    }

    /**
     * List scheduled drafts.
     *
     * @param  int  $limit  Maximum number of drafts to return (default 20, max 100).
     * @param  int  $offset  Number of drafts to skip for pagination.
     * @return array<string, mixed>
     */
    public function listScheduled(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/drafts/scheduled/', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * List published drafts.
     *
     * @param  int  $limit  Maximum number of drafts to return (default 20, max 100).
     * @param  int  $offset  Number of drafts to skip for pagination.
     * @return array<string, mixed>
     */
    public function listPublished(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/drafts/published/', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single draft by its ID.
     *
     * @param  string  $id  The Typefully draft ID.
     * @return array<string, mixed>
     */
    public function getDraft(string $id): array
    {
        return $this->request('GET', '/drafts/' . urlencode($id) . '/');
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
     * Make a raw HTTP request to the Typefully API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Typefully API key is not configured.');
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
                    Log::warning("Typefully API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Typefully API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Typefully API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Typefully API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Typefully API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Typefully API: {$e->getMessage()}");
        }
    }
}
