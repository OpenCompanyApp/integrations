<?php

namespace OpenCompany\Integrations\RetellAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RetellAIService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.retellai.com/v2',
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
     * Create a new phone call.
     *
     * @param  string  $agentId  The Retell AI agent ID to use for the call.
     * @param  array<string, mixed>  $metadata  Optional metadata to attach to the call.
     * @return array<string, mixed> The created call data.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function createCall(string $agentId, array $metadata = []): array
    {
        $payload = [
            'agent_id' => $agentId,
        ];

        if (!empty($metadata)) {
            $payload['metadata'] = $metadata;
        }

        return $this->request('POST', '/create-phone-call', $payload);
    }

    /**
     * Get details for a specific phone call.
     *
     * @param  string  $callId  The unique identifier of the call.
     * @return array<string, mixed> The call data.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/get-phone-call/' . urlencode($callId));
    }

    /**
     * List phone calls.
     *
     * @param  array<string, mixed>  $filters  Optional filter parameters.
     * @return array<string, mixed> The list of calls.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function listCalls(array $filters = []): array
    {
        return $this->request('GET', '/list-phone-calls', $filters);
    }

    /**
     * List all agents.
     *
     * @return array<string, mixed> The list of agents.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function listAgents(): array
    {
        return $this->request('GET', '/list-agents');
    }

    /**
     * Create a new agent.
     *
     * @param  string  $voiceId  The voice ID to assign to the agent.
     * @param  string  $prompt  The system prompt for the agent.
     * @param  array<string, mixed>  $options  Additional agent configuration options.
     * @return array<string, mixed> The created agent data.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function createAgent(string $voiceId, string $prompt, array $options = []): array
    {
        $payload = array_merge([
            'voice_id' => $voiceId,
            'prompt' => $prompt,
        ], $options);

        return $this->request('POST', '/create-agent', $payload);
    }

    /**
     * Get the current user / account information.
     *
     * Uses the list-agents endpoint as a lightweight way to verify credentials
     * and retrieve account-level information.
     *
     * @return array<string, mixed> The current user / account data.
     *
     * @throws \RuntimeException If the API request fails.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/list-agents');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Request payload or query parameters.
     * @return array<string, mixed> The parsed JSON response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Retell AI API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Request payload or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the connection fails, or the response is an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Retell AI API key is not configured.');
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
                    Log::warning("Retell AI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Retell AI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Retell AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Retell AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Retell AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Retell AI API: {$e->getMessage()}");
        }
    }
}
