<?php

namespace OpenCompany\Integrations\Retell;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * RetellService — HTTP client for the Retell AI API.
 *
 * Handles authentication, request building, and error handling for all
 * Retell AI endpoints (calls, agents, and user info).
 *
 * @see https://docs.retellai.com/api-reference
 */
class RetellService
{
    /**
     * Create a new RetellService instance.
     *
     * @param  string  $accessToken  Retell AI API access token.
     * @param  string  $baseUrl  Base URL for the Retell AI API (configurable for self-hosted).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.retellai.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List calls with optional filtering and pagination.
     *
     * @param  int|null  $limit  Maximum number of calls to return.
     * @param  array|null  $filterCriteria  Filter criteria for calls.
     * @param  string|null  $before  Return calls created before this timestamp.
     * @param  string|null  $after  Return calls created after this timestamp.
     * @return array<string, mixed> List of calls.
     *
     * @see https://docs.retellai.com/api-reference/list-calls
     */
    public function listCalls(
        ?int $limit = null,
        ?array $filterCriteria = null,
        ?string $before = null,
        ?string $after = null,
    ): array {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($filterCriteria !== null) {
            $params['filter_criteria'] = $filterCriteria;
        }
        if ($before !== null) {
            $params['before'] = $before;
        }
        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/list-calls', $params);
    }

    /**
     * Get details for a specific call.
     *
     * @param  string  $callId  The unique identifier of the call.
     * @return array<string, mixed> Call details.
     *
     * @see https://docs.retellai.com/api-reference/get-call
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/get-call/' . urlencode($callId));
    }

    /**
     * Create a phone call.
     *
     * @param  string  $agentId  The agent ID to use for the call.
     * @param  array|null  $metadata  Optional metadata to attach to the call.
     * @param  array|null  $retellLlmDynamicVariables  Optional dynamic variables for the LLM.
     * @return array<string, mixed> Created call details.
     *
     * @see https://docs.retellai.com/api-reference/create-phone-call
     */
    public function createPhoneCall(
        string $agentId,
        ?array $metadata = null,
        ?array $retellLlmDynamicVariables = null,
    ): array {
        $body = ['agent_id' => $agentId];
        if ($metadata !== null) {
            $body['metadata'] = $metadata;
        }
        if ($retellLlmDynamicVariables !== null) {
            $body['retell_llm_dynamic_variables'] = $retellLlmDynamicVariables;
        }

        return $this->request('POST', '/create-phone-call', $body);
    }

    /**
     * List all agents.
     *
     * @return array<string, mixed> List of agents.
     *
     * @see https://docs.retellai.com/api-reference/list-agents
     */
    public function listAgents(): array
    {
        return $this->request('GET', '/list-agents');
    }

    /**
     * Get details for a specific agent.
     *
     * @param  string  $agentId  The unique identifier of the agent.
     * @return array<string, mixed> Agent details.
     *
     * @see https://docs.retellai.com/api-reference/get-agent
     */
    public function getAgent(string $agentId): array
    {
        return $this->request('GET', '/get-agent/' . urlencode($agentId));
    }

    /**
     * Create a new agent.
     *
     * @param  string|null  $model  The LLM model to use (e.g., "gpt-4o").
     * @param  string|null  $voiceId  The voice ID to use for the agent.
     * @param  string|null  $prompt  The system prompt for the agent.
     * @param  array|null  $responseEngine  Response engine configuration.
     * @return array<string, mixed> Created agent details.
     *
     * @see https://docs.retellai.com/api-reference/create-agent
     */
    public function createAgent(
        ?string $model = null,
        ?string $voiceId = null,
        ?string $prompt = null,
        ?array $responseEngine = null,
    ): array {
        $body = [];
        if ($model !== null) {
            $body['model'] = $model;
        }
        if ($voiceId !== null) {
            $body['voice_id'] = $voiceId;
        }
        if ($prompt !== null) {
            $body['prompt'] = $prompt;
        }
        if ($responseEngine !== null) {
            $body['response_engine'] = $responseEngine;
        }

        return $this->request('POST', '/create-agent', $body);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> User details.
     *
     * @see https://docs.retellai.com/api-reference/me
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Retell AI API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Retell AI access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                    throw new \RuntimeException("Retell AI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
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
