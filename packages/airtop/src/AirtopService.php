<?php

namespace OpenCompany\Integrations\Airtop;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirtopService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://app.airtop.ai/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Create a new browser session.
     *
     * @param  array<string, mixed>  $options  Optional session configuration (e.g., profile, proxy).
     * @return array<string, mixed>
     */
    public function createSession(array $options = []): array
    {
        return $this->request('POST', '/sessions', $options);
    }

    /**
     * Get details of an existing browser session.
     *
     * @param  string  $id  The session ID.
     * @return array<string, mixed>
     */
    public function getSession(string $id): array
    {
        return $this->request('GET', '/sessions/' . urlencode($id));
    }

    /**
     * Create a new browser window within a session.
     *
     * @param  string  $sessionId  The session ID to create the window in.
     * @param  array<string, mixed>  $options  Optional window configuration (e.g., url, width, height).
     * @return array<string, mixed>
     */
    public function createWindow(string $sessionId, array $options = []): array
    {
        return $this->request('POST', '/sessions/' . urlencode($sessionId) . '/windows', $options);
    }

    /**
     * Get details of a browser window.
     *
     * @param  string  $sessionId  The session ID.
     * @param  string  $windowId   The window ID.
     * @return array<string, mixed>
     */
    public function getWindow(string $sessionId, string $windowId): array
    {
        return $this->request('GET', '/sessions/' . urlencode($sessionId) . '/windows/' . urlencode($windowId));
    }

    /**
     * Navigate a browser window to a URL.
     *
     * @param  string  $sessionId  The session ID.
     * @param  string  $windowId   The window ID.
     * @param  string  $url        The URL to navigate to.
     * @param  array<string, mixed>  $options  Optional navigation parameters.
     * @return array<string, mixed>
     */
    public function navigate(string $sessionId, string $windowId, string $url, array $options = []): array
    {
        return $this->request('POST', '/sessions/' . urlencode($sessionId) . '/windows/' . urlencode($windowId) . '/navigate', array_merge($options, [
            'url' => $url,
        ]));
    }

    /**
     * Get the content of a page in a browser window.
     *
     * @param  string  $sessionId  The session ID.
     * @param  string  $windowId   The window ID.
     * @return array<string, mixed>
     */
    public function getPageContent(string $sessionId, string $windowId): array
    {
        return $this->request('GET', '/sessions/' . urlencode($sessionId) . '/windows/' . urlencode($windowId) . '/content');
    }

    /**
     * List all browser sessions.
     *
     * @return array<string, mixed>
     */
    public function listSessions(): array
    {
        return $this->request('GET', '/sessions');
    }

    /**
     * Get the current authenticated user's profile.
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
     * @param  string  $path   API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Airtop API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path   API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Airtop API key is not configured.');
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
                    Log::warning("Airtop API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Airtop API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Airtop API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Airtop API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Airtop API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Airtop API: {$e->getMessage()}");
        }
    }
}
