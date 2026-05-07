<?php

namespace OpenCompany\Integrations\Cohere;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Cohere API.
 *
 * Handles bearer authentication, JSON endpoints, multipart uploads, optional
 * client attribution, error logging, and response parsing for Cohere tools.
 */
class CohereService
{
    /**
     * @param  string  $apiKey  Cohere API key.
     * @param  string  $baseUrl  Cohere API base URL.
     * @param  string  $clientName  Optional X-Client-Name value.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.cohere.com',
        private string $clientName = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Generate a chat response with Cohere v2 Chat.
     *
     * @param  array<string, mixed>  $body  Chat request body.
     * @return array<string, mixed>
     */
    public function chat(array $body): array
    {
        return $this->request('POST', '/v2/chat', $body, timeout: 120);
    }

    /**
     * Create text, image, or mixed embeddings with Cohere v2 Embed.
     *
     * @param  array<string, mixed>  $body  Embed request body.
     * @return array<string, mixed>
     */
    public function embed(array $body): array
    {
        return $this->request('POST', '/v2/embed', $body, timeout: 120);
    }

    /**
     * Rerank documents for a search query.
     *
     * @param  array<string, mixed>  $body  Rerank request body.
     * @return array<string, mixed>
     */
    public function rerank(array $body): array
    {
        return $this->request('POST', '/v2/rerank', $body);
    }

    /**
     * Tokenize text with the tokenizer for a model.
     *
     * @param  array<string, mixed>  $body  Tokenize request body.
     * @return array<string, mixed>
     */
    public function tokenize(array $body): array
    {
        return $this->request('POST', '/v1/tokenize', $body);
    }

    /**
     * Convert model tokens back to text.
     *
     * @param  array<string, mixed>  $body  Detokenize request body.
     * @return array<string, mixed>
     */
    public function detokenize(array $body): array
    {
        return $this->request('POST', '/v1/detokenize', $body);
    }

    /**
     * List models available to the authenticated account.
     *
     * @param  array<string, mixed>  $params  Query parameters: page_size, page_token, endpoint, default_only.
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/v1/models', $params);
    }

    /**
     * Retrieve metadata for one model.
     *
     * @return array<string, mixed>
     */
    public function getModel(string $model): array
    {
        return $this->request('GET', '/v1/models/' . rawurlencode($model));
    }

    /**
     * Classify text with Cohere's deprecated v1 Classify endpoint.
     *
     * @param  array<string, mixed>  $body  Classify request body.
     * @return array<string, mixed>
     */
    public function classify(array $body): array
    {
        return $this->request('POST', '/v1/classify', $body);
    }

    /**
     * Create an asynchronous embed job for an embed-input dataset.
     *
     * @param  array<string, mixed>  $body  Embed job request body.
     * @return array<string, mixed>
     */
    public function createEmbedJob(array $body): array
    {
        return $this->request('POST', '/v1/embed-jobs', $body);
    }

    /**
     * List embed jobs for the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listEmbedJobs(): array
    {
        return $this->request('GET', '/v1/embed-jobs');
    }

    /**
     * Retrieve one embed job by ID.
     *
     * @return array<string, mixed>
     */
    public function getEmbedJob(string $jobId): array
    {
        return $this->request('GET', '/v1/embed-jobs/' . rawurlencode($jobId));
    }

    /**
     * Cancel an active embed job.
     *
     * @return array<string, mixed>
     */
    public function cancelEmbedJob(string $jobId): array
    {
        return $this->request('POST', '/v1/embed-jobs/' . rawurlencode($jobId) . '/cancel');
    }

    /**
     * Upload a dataset file for Cohere dataset-backed workflows.
     *
     * @param  array<string, mixed>  $options  Dataset query parameters.
     * @return array<string, mixed>
     */
    public function createDataset(string $filename, string $content, array $options, ?string $evalFilename = null, ?string $evalContent = null): array
    {
        $response = $this->multipartRequest('/v1/datasets', $options, [
            ['name' => 'data', 'filename' => $filename, 'content' => $content],
            ...(($evalFilename !== null && $evalContent !== null) ? [[
                'name' => 'eval_data',
                'filename' => $evalFilename,
                'content' => $evalContent,
            ]] : []),
        ]);

        return $response->json() ?? [];
    }

    /**
     * List datasets created by the authenticated account.
     *
     * @param  array<string, mixed>  $params  Query parameters for dataset filtering and pagination.
     * @return array<string, mixed>
     */
    public function listDatasets(array $params = []): array
    {
        return $this->request('GET', '/v1/datasets', $params);
    }

    /**
     * Retrieve one dataset by ID.
     *
     * @return array<string, mixed>
     */
    public function getDataset(string $datasetId): array
    {
        return $this->request('GET', '/v1/datasets/' . rawurlencode($datasetId));
    }

    /**
     * Delete one dataset by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteDataset(string $datasetId): array
    {
        return $this->request('DELETE', '/v1/datasets/' . rawurlencode($datasetId));
    }

    /**
     * Get organization dataset storage usage in bytes.
     *
     * @return array<string, mixed>
     */
    public function getDatasetUsage(): array
    {
        return $this->request('GET', '/v1/datasets/usage');
    }

    /**
     * Transcribe an audio file with Cohere v2 Audio Transcriptions.
     *
     * @return array<string, mixed>
     */
    public function createAudioTranscription(string $filename, string $content, string $model, string $language, ?float $temperature = null): array
    {
        $fields = [
            'model' => $model,
            'language' => $language,
        ];

        if ($temperature !== null) {
            $fields['temperature'] = $temperature;
        }

        $response = $this->multipartRequest('/v2/audio/transcriptions', [], [
            ['name' => 'file', 'filename' => $filename, 'content' => $content],
        ], $fields);

        return $response->json() ?? [];
    }

    /**
     * Make a JSON API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], int $timeout = 60): array
    {
        $response = $this->rawRequest($method, $path, $data, $timeout);

        return $response->json() ?? [];
    }

    /**
     * Make a raw JSON HTTP request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     */
    private function rawRequest(string $method, string $path, array $data = [], int $timeout = 60): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Cohere API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders($this->headers())->timeout($timeout);
            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->ensureSuccessful($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Cohere API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Cohere API: {$e->getMessage()}");
        }
    }

    /**
     * Make a multipart HTTP request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<int, array{name: string, filename: string, content: string}>  $files  Files to attach.
     * @param  array<string, mixed>  $fields  Multipart form fields.
     */
    private function multipartRequest(string $path, array $query, array $files, array $fields = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Cohere API key is not configured.');
        }

        $url = $this->baseUrl . $path;
        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        try {
            $http = Http::withHeaders($this->headers(includeContentType: false))->timeout(180);

            foreach ($files as $file) {
                $http = $http->attach($file['name'], $file['content'], $file['filename']);
            }

            $response = $http->post($url, $fields);

            return $this->ensureSuccessful($response, 'POST', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Cohere API connection error: POST {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Cohere API: {$e->getMessage()}");
        }
    }

    /**
     * Build request headers.
     *
     * @return array<string, string>
     */
    private function headers(bool $includeContentType = true): array
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
        ];

        if ($includeContentType) {
            $headers['Content-Type'] = 'application/json';
        }

        if ($this->clientName !== '') {
            $headers['X-Client-Name'] = $this->clientName;
        }

        return $headers;
    }

    /**
     * Throw a normalized exception for failed responses.
     */
    private function ensureSuccessful(Response $response, string $method, string $path): Response
    {
        if ($response->successful()) {
            return $response;
        }

        $error = $response->json('message')
            ?? $response->json('error.message')
            ?? $response->json('error')
            ?? $response->body();

        Log::error("Cohere API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("Cohere API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
