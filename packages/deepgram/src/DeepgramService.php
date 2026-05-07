<?php

namespace OpenCompany\Integrations\Deepgram;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Deepgram REST API.
 *
 * Handles token authentication, JSON endpoints, binary audio upload, TTS
 * binary output, management APIs, error logging, and response parsing.
 */
class DeepgramService
{
    /**
     * @param  string  $apiKey  Deepgram API key.
     * @param  string  $baseUrl  Deepgram API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.deepgram.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Transcribe prerecorded media by URL.
     *
     * @param  array<string, mixed>  $body  Body containing url.
     * @param  array<string, mixed>  $params  Listen query parameters.
     * @return array<string, mixed>
     */
    public function transcribeUrl(array $body, array $params = []): array
    {
        return $this->request('POST', '/listen', $body, $params, timeout: 300);
    }

    /**
     * Transcribe prerecorded media from raw audio bytes.
     *
     * @param  array<string, mixed>  $params  Listen query parameters.
     * @return array<string, mixed>
     */
    public function transcribeAudio(string $content, string $contentType, array $params = []): array
    {
        $response = $this->rawBinaryRequest('POST', '/listen', $content, $contentType, $params, 300);

        return $response->json() ?? [];
    }

    /**
     * Analyze text or a URL with Deepgram Text Intelligence.
     *
     * @param  array<string, mixed>  $body  Body containing text or url.
     * @param  array<string, mixed>  $params  Read query parameters.
     * @return array<string, mixed>
     */
    public function analyzeText(array $body, array $params = []): array
    {
        return $this->request('POST', '/read', $body, $params, timeout: 120);
    }

    /**
     * Generate speech audio from text.
     *
     * @param  array<string, mixed>  $body  Body containing text.
     * @param  array<string, mixed>  $params  Speak query parameters.
     * @return array<string, mixed>
     */
    public function speak(array $body, array $params = []): array
    {
        $response = $this->rawRequest('POST', '/speak', $body, $params, 180);

        return [
            'content_type' => (string) $response->header('Content-Type'),
            'audio_base64' => base64_encode($response->body()),
        ];
    }

    /**
     * List public Deepgram models.
     *
     * @param  array<string, mixed>  $params  Model query parameters.
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', [], $params);
    }

    /**
     * Get public model metadata.
     *
     * @return array<string, mixed>
     */
    public function getModel(string $modelId): array
    {
        return $this->request('GET', '/models/' . rawurlencode($modelId));
    }

    /**
     * List projects visible to the API key.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get one project by ID.
     *
     * @param  array<string, mixed>  $params  Optional pagination parameters.
     * @return array<string, mixed>
     */
    public function getProject(string $projectId, array $params = []): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId), [], $params);
    }

    /**
     * Update project settings such as name.
     *
     * @param  array<string, mixed>  $body  Project update body.
     * @return array<string, mixed>
     */
    public function updateProject(string $projectId, array $body): array
    {
        return $this->request('PATCH', '/projects/' . rawurlencode($projectId), $body);
    }

    /**
     * List project API keys.
     *
     * @param  array<string, mixed>  $params  Query parameters such as status.
     * @return array<string, mixed>
     */
    public function listProjectKeys(string $projectId, array $params = []): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/keys', [], $params);
    }

    /**
     * Create a project API key.
     *
     * @param  array<string, mixed>  $body  API key creation body.
     * @return array<string, mixed>
     */
    public function createProjectKey(string $projectId, array $body): array
    {
        return $this->request('POST', '/projects/' . rawurlencode($projectId) . '/keys', $body);
    }

    /**
     * Delete a project API key.
     *
     * @return array<string, mixed>
     */
    public function deleteProjectKey(string $projectId, string $keyId): array
    {
        return $this->request('DELETE', '/projects/' . rawurlencode($projectId) . '/keys/' . rawurlencode($keyId));
    }

    /**
     * List outstanding project balances.
     *
     * @return array<string, mixed>
     */
    public function listProjectBalances(string $projectId): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/balances');
    }

    /**
     * Get one project balance.
     *
     * @return array<string, mixed>
     */
    public function getProjectBalance(string $projectId, string $balanceId): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/balances/' . rawurlencode($balanceId));
    }

    /**
     * Get project usage breakdown.
     *
     * @param  array<string, mixed>  $params  Usage filters and grouping controls.
     * @return array<string, mixed>
     */
    public function getUsageBreakdown(string $projectId, array $params = []): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/usage/breakdown', [], $params);
    }

    /**
     * Get one project request by ID.
     *
     * @return array<string, mixed>
     */
    public function getProjectRequest(string $projectId, string $requestId): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/requests/' . rawurlencode($requestId));
    }

    /**
     * List models available to a project, including private models.
     *
     * @param  array<string, mixed>  $params  Model query parameters.
     * @return array<string, mixed>
     */
    public function listProjectModels(string $projectId, array $params = []): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/models', [], $params);
    }

    /**
     * Get project-specific model metadata.
     *
     * @return array<string, mixed>
     */
    public function getProjectModel(string $projectId, string $modelId): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectId) . '/models/' . rawurlencode($modelId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $params = [], int $timeout = 60): array
    {
        $response = $this->rawRequest($method, $path, $body, $params, $timeout);

        return $response->json() ?? [];
    }

    /**
     * Make a raw JSON HTTP request.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $params  Query parameters.
     */
    private function rawRequest(string $method, string $path, array $body = [], array $params = [], int $timeout = 60): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Deepgram API key is not configured.');
        }

        $url = $this->url($path, $params);

        try {
            $http = Http::withHeaders($this->headers())->timeout($timeout);
            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->ensureSuccessful($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Deepgram API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Deepgram API: {$e->getMessage()}");
        }
    }

    /**
     * Make a raw binary upload request.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     */
    private function rawBinaryRequest(string $method, string $path, string $content, string $contentType, array $params = [], int $timeout = 60): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Deepgram API key is not configured.');
        }

        try {
            $response = Http::withHeaders($this->headers($contentType))
                ->timeout($timeout)
                ->withBody($content, $contentType)
                ->post($this->url($path, $params));

            return $this->ensureSuccessful($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Deepgram API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Deepgram API: {$e->getMessage()}");
        }
    }

    /**
     * Build request headers.
     *
     * @return array<string, string>
     */
    private function headers(string $contentType = 'application/json'): array
    {
        return [
            'Authorization' => 'Token ' . $this->apiKey,
            'Content-Type' => $contentType,
        ];
    }

    /**
     * Build a URL with encoded query parameters.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     */
    private function url(string $path, array $params = []): string
    {
        $url = $this->baseUrl . $path;

        return $params === [] ? $url : $url . '?' . http_build_query($params);
    }

    /**
     * Throw a normalized exception for failed responses.
     */
    private function ensureSuccessful(Response $response, string $method, string $path): Response
    {
        if ($response->successful()) {
            return $response;
        }

        $error = $response->json('err_msg')
            ?? $response->json('message')
            ?? $response->json('error.message')
            ?? $response->json('error')
            ?? $response->body();

        Log::error("Deepgram API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Deepgram API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
