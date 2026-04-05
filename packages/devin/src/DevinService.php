<?php

namespace OpenCompany\Integrations\Devin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DevinService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.devin.ai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Devin integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Create a new Devin session.
     *
     * @param  string  $prompt  The task prompt for Devin to execute.
     * @param  string|null  $idempotencyKey  Optional idempotency key to prevent duplicate session creation.
     * @return array<string, mixed> The created session data.
     */
    public function createSession(string $prompt, ?string $idempotencyKey = null): array
    {
        $data = ['prompt' => $prompt];

        if ($idempotencyKey !== null) {
            $data['idempotency_key'] = $idempotencyKey;
        }

        return $this->request('POST', '/sessions', $data);
    }

    /**
     * Get details of a specific Devin session.
     *
     * @param  string  $sessionId  The session ID to retrieve.
     * @return array<string, mixed> The session data.
     */
    public function getSession(string $sessionId): array
    {
        return $this->request('GET', '/sessions/' . urlencode($sessionId));
    }

    /**
     * List all Devin sessions.
     *
     * @return array<string, mixed> The list of sessions.
     */
    public function listSessions(): array
    {
        return $this->request('GET', '/sessions');
    }

    /**
     * Send a message to an existing Devin session.
     *
     * @param  string  $sessionId  The session ID to send the message to.
     * @param  string  $message  The message content to send.
     * @return array<string, mixed> The response data.
     */
    public function sendMessage(string $sessionId, string $message): array
    {
        return $this->request('POST', '/sessions/' . urlencode($sessionId) . '/message', [
            'message' => $message,
        ]);
    }

    /**
     * Get the currently authenticated Devin user.
     *
     * @return array<string, mixed> The current user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/sessions');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Devin API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Devin API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

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
                    Log::warning("Devin API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Devin API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Devin API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Devin API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Devin API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Devin API: {$e->getMessage()}");
        }
    }
}
