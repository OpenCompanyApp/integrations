<?php

namespace OpenCompany\Integrations\RetellAI;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Retell AI API.
 *
 * Handles bearer authentication, Retell's mixed root and /v2 endpoint paths,
 * and normalized API errors for agents, calls, numbers, LLMs, and voices.
 */
class RetellAIService
{
    /**
     * @param  string  $apiKey  Retell AI API key.
     * @param  string  $baseUrl  Retell AI API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.retellai.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        if (str_ends_with($this->baseUrl, '/v2')) {
            $this->baseUrl = substr($this->baseUrl, 0, -3);
        }
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Create a new phone call.
     *
     * @param  string  $agentId  Agent ID for the call.
     * @param  array<string, mixed>  $metadata  Metadata to attach to the call.
     * @param  array<string, mixed>  $options  Additional create-phone-call fields such as from_number, to_number, override_agent_id, and retell_llm_dynamic_variables.
     * @return array<string, mixed>
     */
    public function createCall(string $agentId, array $metadata = [], array $options = []): array
    {
        $payload = array_merge($options, ['agent_id' => $agentId]);

        if ($metadata !== []) {
            $payload['metadata'] = $metadata;
        }

        return $this->request('POST', '/v2/create-phone-call', $payload);
    }

    /**
     * Create a web call.
     *
     * @param  array<string, mixed>  $payload  Web call payload.
     * @return array<string, mixed>
     */
    public function createWebCall(array $payload): array
    {
        return $this->request('POST', '/v2/create-web-call', $payload);
    }

    /**
     * Register an externally handled phone call with Retell.
     *
     * @param  array<string, mixed>  $payload  Register-phone-call payload.
     * @return array<string, mixed>
     */
    public function registerPhoneCall(array $payload): array
    {
        return $this->request('POST', '/v2/register-phone-call', $payload);
    }

    /**
     * Get details for a specific call.
     *
     * @return array<string, mixed>
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/v2/get-call/' . rawurlencode($callId));
    }

    /**
     * List calls.
     *
     * @param  array<string, mixed>  $filters  Filter body for /v2/list-calls.
     * @return array<string, mixed>
     */
    public function listCalls(array $filters = []): array
    {
        return $this->request('POST', '/v2/list-calls', $filters);
    }

    /**
     * Update call metadata.
     *
     * @param  array<string, mixed>  $metadata  Metadata payload.
     * @return array<string, mixed>
     */
    public function updateCall(string $callId, array $metadata): array
    {
        return $this->request('PATCH', '/v2/update-call/' . rawurlencode($callId), $metadata);
    }

    /**
     * Stop an in-progress call.
     *
     * @return array<string, mixed>
     */
    public function stopCall(string $callId): array
    {
        return $this->request('POST', '/v2/stop-call/' . rawurlencode($callId));
    }

    /**
     * Delete a call record.
     *
     * @return array<string, mixed>
     */
    public function deleteCall(string $callId): array
    {
        return $this->request('DELETE', '/v2/delete-call/' . rawurlencode($callId));
    }

    /**
     * List voice agents.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAgents(array $params = []): array
    {
        return $this->request('GET', '/list-agents', $params);
    }

    /**
     * Get a voice agent.
     *
     * @return array<string, mixed>
     */
    public function getAgent(string $agentId): array
    {
        return $this->request('GET', '/get-agent/' . rawurlencode($agentId));
    }

    /**
     * Create a voice agent.
     *
     * @param  string  $voiceId  Voice ID for the agent.
     * @param  string  $prompt  Prompt or legacy prompt value.
     * @param  array<string, mixed>  $options  Additional Retell agent fields.
     * @return array<string, mixed>
     */
    public function createAgent(string $voiceId, string $prompt, array $options = []): array
    {
        return $this->request('POST', '/create-agent', array_merge([
            'voice_id' => $voiceId,
            'prompt' => $prompt,
        ], $options));
    }

    /**
     * Update a voice agent.
     *
     * @param  array<string, mixed>  $payload  Agent update payload.
     * @return array<string, mixed>
     */
    public function updateAgent(string $agentId, array $payload): array
    {
        return $this->request('PATCH', '/update-agent/' . rawurlencode($agentId), $payload);
    }

    /**
     * Publish a voice agent draft.
     *
     * @return array<string, mixed>
     */
    public function publishAgent(string $agentId): array
    {
        return $this->request('POST', '/publish-agent/' . rawurlencode($agentId));
    }

    /**
     * Delete a voice agent.
     *
     * @return array<string, mixed>
     */
    public function deleteAgent(string $agentId): array
    {
        return $this->request('DELETE', '/delete-agent/' . rawurlencode($agentId));
    }

    /**
     * List phone numbers.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/v2/list-phone-numbers', $params);
    }

    /**
     * Get a phone number.
     *
     * @return array<string, mixed>
     */
    public function getPhoneNumber(string $phoneNumber): array
    {
        return $this->request('GET', '/get-phone-number/' . rawurlencode($phoneNumber));
    }

    /**
     * Create or purchase a phone number.
     *
     * @param  array<string, mixed>  $payload  Create-phone-number payload.
     * @return array<string, mixed>
     */
    public function createPhoneNumber(array $payload): array
    {
        return $this->request('POST', '/create-phone-number', $payload);
    }

    /**
     * Import a phone number.
     *
     * @param  array<string, mixed>  $payload  Import-phone-number payload.
     * @return array<string, mixed>
     */
    public function importPhoneNumber(array $payload): array
    {
        return $this->request('POST', '/import-phone-number', $payload);
    }

    /**
     * Update a phone number.
     *
     * @param  array<string, mixed>  $payload  Phone number update payload.
     * @return array<string, mixed>
     */
    public function updatePhoneNumber(string $phoneNumber, array $payload): array
    {
        return $this->request('PATCH', '/update-phone-number/' . rawurlencode($phoneNumber), $payload);
    }

    /**
     * Delete a phone number.
     *
     * @return array<string, mixed>
     */
    public function deletePhoneNumber(string $phoneNumber): array
    {
        return $this->request('DELETE', '/delete-phone-number/' . rawurlencode($phoneNumber));
    }

    /**
     * List Retell LLMs.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listRetellLlms(array $params = []): array
    {
        return $this->request('GET', '/v2/list-retell-llms', $params);
    }

    /**
     * Get a Retell LLM.
     *
     * @return array<string, mixed>
     */
    public function getRetellLlm(string $llmId): array
    {
        return $this->request('GET', '/get-retell-llm/' . rawurlencode($llmId));
    }

    /**
     * Create a Retell LLM.
     *
     * @param  array<string, mixed>  $payload  LLM creation payload.
     * @return array<string, mixed>
     */
    public function createRetellLlm(array $payload): array
    {
        return $this->request('POST', '/create-retell-llm', $payload);
    }

    /**
     * Update a Retell LLM.
     *
     * @param  array<string, mixed>  $payload  LLM update payload.
     * @return array<string, mixed>
     */
    public function updateRetellLlm(string $llmId, array $payload): array
    {
        return $this->request('PATCH', '/update-retell-llm/' . rawurlencode($llmId), $payload);
    }

    /**
     * Delete a Retell LLM.
     *
     * @return array<string, mixed>
     */
    public function deleteRetellLlm(string $llmId): array
    {
        return $this->request('DELETE', '/delete-retell-llm/' . rawurlencode($llmId));
    }

    /**
     * List voices.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listVoices(array $params = []): array
    {
        return $this->request('GET', '/list-voices', $params);
    }

    /**
     * Get a voice by ID.
     *
     * @return array<string, mixed>
     */
    public function getVoice(string $voiceId): array
    {
        return $this->request('GET', '/get-voice/' . rawurlencode($voiceId));
    }

    /**
     * Search community voices.
     *
     * @param  array<string, mixed>  $payload  Community voice search payload.
     * @return array<string, mixed>
     */
    public function searchCommunityVoice(array $payload): array
    {
        return $this->request('POST', '/search-community-voice', $payload);
    }

    /**
     * Get lightweight account information by listing agents.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->listAgents();
    }

    /**
     * Call a documented Retell GET endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a documented Retell POST endpoint.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call a documented Retell PATCH endpoint.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = []): array
    {
        return $this->request('PATCH', $path, $body);
    }

    /**
     * Call a documented Retell DELETE endpoint.
     *
     * @param  array<string, mixed>  $body  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $path, $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        return $this->jsonResponse($this->rawRequest($method, $path, $data));
    }

    /**
     * Make a raw HTTP request to the Retell AI API.
     *
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Retell AI API key is not configured.');
        }

        $url = $this->url($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Retell AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Retell AI API: {$e->getMessage()}");
        }
    }

    /**
     * Build a full API URL from a relative path.
     */
    private function url(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Retell AI API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use a Retell AI API path relative to the configured base URL.');
        }

        return $this->baseUrl . '/' . $path;
    }

    /**
     * Return parsed JSON from a response.
     *
     * @return array<string, mixed>
     */
    private function jsonResponse(Response $response): array
    {
        return $response->json() ?? [];
    }

    /**
     * Throw a normalized API exception.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = (string) $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Retell AI API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);
            throw new \RuntimeException("Retell AI API returned an unexpected response (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;
        Log::error("Retell AI API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);
        throw new \RuntimeException("Retell AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
