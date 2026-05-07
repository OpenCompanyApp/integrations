<?php

namespace OpenCompany\Integrations\EdenAi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Eden AI V2 and V3 API operations.
 *
 * Keeps legacy V2 helper methods available while exposing the current V3 chat,
 * Universal AI, model discovery, file, and async-job endpoints.
 */
class EdenAiService
{
    private string $v3BaseUrl;

    /**
     * @param  string  $apiKey  Eden AI API key.
     * @param  string  $baseUrl  Base URL for legacy Eden AI V2 endpoints.
     * @param  string|null  $v3BaseUrl  Base URL for Eden AI V3 endpoints.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.edenai.run/v2',
        ?string $v3BaseUrl = null,
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->v3BaseUrl = rtrim($v3BaseUrl ?: $this->deriveV3BaseUrl($this->baseUrl), '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Generate text using AI providers.
     *
     * @param  array<string, mixed>  $body  Request body containing providers, text, and optional parameters.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function generateText(array $body): array
    {
        return $this->request('POST', '/text/generation', $body);
    }

    /**
     * Analyze an image using AI providers.
     *
     * @param  array<string, mixed>  $body  Request body containing providers, image URL or base64, and features.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function analyzeImage(array $body): array
    {
        return $this->request('POST', '/image/analyze', $body);
    }

    /**
     * Translate text using AI providers.
     *
     * @param  array<string, mixed>  $body  Request body containing providers, source_language, target_language, and text.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function translateText(array $body): array
    {
        return $this->request('POST', '/translation/translate', $body);
    }

    /**
     * Transcribe audio using AI providers.
     *
     * @param  array<string, mixed>  $body  Request body containing providers and audio URL or base64.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function transcribeAudio(array $body): array
    {
        return $this->request('POST', '/audio/transcription', $body);
    }

    /**
     * Perform OCR (Optical Character Recognition) asynchronously.
     *
     * @param  array<string, mixed>  $body  Request body containing providers and document URL or base64.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function ocr(array $body): array
    {
        return $this->request('POST', '/ocr/async', $body);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Create a V3 OpenAI-compatible chat completion.
     *
     * @param  array<string, mixed>  $body  Chat completion request body.
     * @return array<string, mixed>
     */
    public function chatCompletions(array $body): array
    {
        return $this->request('POST', '/chat/completions', $body, true);
    }

    /**
     * List Eden AI V3 LLM models.
     *
     * @param  array<string, mixed>  $params  Optional query parameters.
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', $params, true);
    }

    /**
     * Call Eden AI V3 Universal AI synchronously.
     *
     * @param  array<string, mixed>  $body  Universal AI request body.
     * @return array<string, mixed>
     */
    public function universalAi(array $body): array
    {
        return $this->request('POST', '/universal-ai', $body, true);
    }

    /**
     * Submit an Eden AI V3 Universal AI async job.
     *
     * @param  array<string, mixed>  $body  Universal AI async request body.
     * @return array<string, mixed>
     */
    public function universalAiAsync(array $body): array
    {
        return $this->request('POST', '/universal-ai/async', $body, true);
    }

    /**
     * Retrieve an Eden AI V3 Universal AI async job.
     *
     * @param  string  $jobId  Public job ID.
     * @return array<string, mixed>
     */
    public function getUniversalAiJob(string $jobId): array
    {
        return $this->request('GET', '/universal-ai/async/' . rawurlencode($jobId), [], true);
    }

    /**
     * List V3 expert model features and subfeatures.
     *
     * @return array<string, mixed>
     */
    public function listFeatures(): array
    {
        return $this->request('GET', '/info', [], true);
    }

    /**
     * Get V3 discovery info for a feature or subfeature path.
     *
     * @param  string  $featurePath  Feature path such as text/moderation.
     * @return array<string, mixed>
     */
    public function getFeatureInfo(string $featurePath): array
    {
        return $this->request('GET', '/info/' . $this->normalizePath($featurePath), [], true);
    }

    /**
     * Upload a file to Eden AI V3 persistent file storage.
     *
     * @param  string  $filePath  Local file path.
     * @param  string|null  $purpose  Optional upload purpose.
     * @return array<string, mixed>
     */
    public function uploadFile(string $filePath, ?string $purpose = null): array
    {
        if (!is_file($filePath)) {
            throw new \InvalidArgumentException('A valid file_path is required.');
        }

        if ($this->apiKey === '') {
            throw new \RuntimeException('Eden AI API key is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ])->attach('file', file_get_contents($filePath), basename($filePath))->timeout(120);

            $response = $http->post($this->v3BaseUrl . '/upload', array_filter([
                'purpose' => $purpose,
            ], static fn ($value): bool => $value !== null && $value !== ''));

            if (!$response->successful()) {
                $this->throwApiError('POST', '/upload', $response);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Eden AI API connection error: POST /upload', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Eden AI API: {$e->getMessage()}");
        }
    }

    /**
     * Delete all V3 uploaded files for the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function deleteAllUploadedFiles(): array
    {
        return $this->request('DELETE', '/upload', [], true);
    }

    /**
     * Call a legacy Eden AI V2 GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v2.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a legacy Eden AI V2 POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v2.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call an Eden AI V3 GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v3.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function v3ApiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params, true);
    }

    /**
     * Call an Eden AI V3 POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v3.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function v3ApiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body, true);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST).
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = [], bool $v3 = false): array
    {
        $response = $this->rawRequest($method, $path, $data, $v3);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Eden AI API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request payload or query parameters.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $v3 = false): \Illuminate\Http\Client\Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('Eden AI API key is not configured.');
        }

        $url = ($v3 ? $this->v3BaseUrl : $this->baseUrl) . '/' . $this->normalizePath($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Eden AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Eden AI API: {$e->getMessage()}");
        }
    }

    /**
     * Convert a V2 base URL to the default V3 base URL.
     */
    private function deriveV3BaseUrl(string $baseUrl): string
    {
        if (str_ends_with($baseUrl, '/v2')) {
            return substr($baseUrl, 0, -3) . '/v3';
        }

        return 'https://api.edenai.run/v3';
    }

    /**
     * Normalize a relative API path and reject absolute URLs.
     */
    private function normalizePath(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Eden AI API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use an Eden AI API path relative to the configured base URL.');
        }

        return $path;
    }

    /**
     * Throw a normalized API exception.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, \Illuminate\Http\Client\Response $response): never
    {
        $contentType = (string) $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Eden AI API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);
            throw new \RuntimeException("Eden AI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $response->json('detail') ?? $body;
        Log::error("Eden AI API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);
        throw new \RuntimeException("Eden AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
