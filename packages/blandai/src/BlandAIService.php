<?php

namespace OpenCompany\Integrations\BlandAI;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Bland AI API.
 *
 * Handles authentication, v1/v2 endpoint routing, response parsing, and errors for calls,
 * batches, voices, tools, and knowledge-base workflows.
 */
class BlandAIService
{
    /**
     * @param  string  $apiKey  Bland AI API key
     * @param  string  $baseUrl  Bland AI API host, with or without a trailing /v1 or /v2
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.bland.ai',
    ) {
        $this->baseUrl = preg_replace('#/(v1|v2)$#', '', rtrim($this->baseUrl, '/')) ?: 'https://api.bland.ai';
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Send a dynamic AI phone call.
     *
     * @param  array<string, mixed>  $params  Send Call request body
     * @return array<string, mixed>
     */
    public function sendCall(array $params): array
    {
        return $this->request('POST', '/v1/calls', $params);
    }

    /**
     * Backward-compatible helper for the old make-call signature.
     *
     * @param  string  $phoneNumber  Phone number to call
     * @param  string  $task  Call objective or task
     * @param  string|null  $voice  Optional voice id/name
     * @param  array<string, mixed>  $options  Additional Send Call parameters
     * @return array<string, mixed>
     */
    public function makeCall(string $phoneNumber, string $task, ?string $voice = null, array $options = []): array
    {
        $params = array_merge($options, [
            'phone_number' => $phoneNumber,
            'task' => $task,
        ]);

        if ($voice !== null) {
            $params['voice'] = $voice;
        }

        return $this->sendCall($params);
    }

    /**
     * Retrieve details for a specific call.
     *
     * @param  string  $callId  Call ID
     * @return array<string, mixed>
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/v1/calls/' . rawurlencode($callId));
    }

    /**
     * List calls with optional filters and cursor pagination.
     *
     * @param  array<string, mixed>  $filters  Query filters such as from_number, to_number, batch_id, start_date, end_date, limit, or after
     * @return array<string, mixed>
     */
    public function listCalls(array $filters = []): array
    {
        return $this->request('GET', '/v1/calls', $filters);
    }

    /**
     * Stop an active call.
     *
     * @param  string  $callId  Call ID
     * @return array<string, mixed>
     */
    public function stopCall(string $callId): array
    {
        return $this->request('POST', '/v1/calls/' . rawurlencode($callId) . '/stop');
    }

    /**
     * Stop all active calls.
     *
     * @return array<string, mixed>
     */
    public function stopAllActiveCalls(): array
    {
        return $this->request('POST', '/v1/calls/active/stop');
    }

    /**
     * Analyze a completed call.
     *
     * @param  string  $callId  Call ID
     * @param  string  $goal  Analysis goal
     * @param  array<int, array<int, string>>  $questions  Analysis questions and expected answer types
     * @return array<string, mixed>
     */
    public function analyzeCall(string $callId, string $goal, array $questions = []): array
    {
        return $this->request('POST', '/v1/calls/' . rawurlencode($callId) . '/analyze', [
            'goal' => $goal,
            'questions' => $questions,
        ]);
    }

    /**
     * Create a v2 batch or campaign.
     *
     * @param  array<string, mixed>  $params  Batch request body
     * @return array<string, mixed>
     */
    public function createBatch(array $params): array
    {
        return $this->request('POST', '/v2/batches', $params);
    }

    /**
     * List v2 batches.
     *
     * @param  array<string, mixed>  $params  Query parameters such as take and skip
     * @return array<string, mixed>
     */
    public function listBatches(array $params = []): array
    {
        return $this->request('GET', '/v2/batches/list', $params);
    }

    /**
     * List available voices.
     *
     * @return array<string, mixed>
     */
    public function listVoices(): array
    {
        return $this->request('GET', '/v1/voices');
    }

    /**
     * Get voice details.
     *
     * @param  string  $voiceId  Voice name or id
     * @return array<string, mixed>
     */
    public function getVoice(string $voiceId): array
    {
        return $this->request('GET', '/v1/voices/' . rawurlencode($voiceId));
    }

    /**
     * List knowledge bases.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit, offset, or status
     * @return array<string, mixed>
     */
    public function listKnowledgeBases(array $params = []): array
    {
        return $this->request('GET', '/v1/knowledge', $params);
    }

    /**
     * Create a text knowledge base through the current knowledge/learn endpoint.
     *
     * @param  string  $name  Knowledge base name
     * @param  string  $text  Knowledge base text content
     * @param  string|null  $description  Optional description
     * @return array<string, mixed>
     */
    public function createTextKnowledgeBase(string $name, string $text, ?string $description = null): array
    {
        return $this->request('POST', '/v1/knowledge/learn', array_filter([
            'type' => 'text',
            'name' => $name,
            'text' => $text,
            'description' => $description,
        ], static fn (mixed $value): bool => $value !== null && $value !== ''));
    }

    /**
     * Update knowledge base metadata.
     *
     * @param  string  $knowledgeBaseId  Knowledge base ID
     * @param  array<string, mixed>  $params  Metadata fields such as name and description
     * @return array<string, mixed>
     */
    public function updateKnowledgeBase(string $knowledgeBaseId, array $params): array
    {
        return $this->request('PUT', '/v1/knowledge/' . rawurlencode($knowledgeBaseId), $params);
    }

    /**
     * Chat with a knowledge base.
     *
     * @param  string  $knowledgeBaseId  Knowledge base ID
     * @param  array<int, array<string, string>>  $messages  Chat messages
     * @return array<string, mixed>
     */
    public function chatKnowledgeBase(string $knowledgeBaseId, array $messages): array
    {
        return $this->request('POST', '/v1/knowledge/chat', [
            'knowledge_base_id' => $knowledgeBaseId,
            'messages' => $messages,
        ]);
    }

    /**
     * Create a custom tool for call agents.
     *
     * @param  array<string, mixed>  $params  Tool definition
     * @return array<string, mixed>
     */
    public function createTool(array $params): array
    {
        return $this->request('POST', '/v1/tools', $params);
    }

    /**
     * Get account context using a lightweight documented call-list request.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->listCalls(['limit' => 1]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path including version
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw HTTP request.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path including version
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('BlandAI API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("BlandAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to BlandAI API: {$e->getMessage()}");
        }
    }

    /**
     * Log and throw a normalized API error.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("BlandAI API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("BlandAI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;

        Log::error("BlandAI API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("BlandAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
