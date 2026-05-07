<?php

namespace OpenCompany\Integrations\VoyageAi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Voyage AI API.
 *
 * Handles bearer authentication, JSON endpoints, multipart file uploads,
 * file-content retrieval, error logging, and response parsing.
 */
class VoyageAiService
{
    /**
     * @param  string  $apiKey  Voyage AI API key.
     * @param  string  $baseUrl  Voyage AI API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.voyageai.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Create text embeddings.
     *
     * @param  array<string, mixed>  $body  Embeddings request body.
     * @return array<string, mixed>
     */
    public function createEmbedding(array $body): array
    {
        return $this->request('POST', '/embeddings', $body);
    }

    /**
     * Create contextualized chunk embeddings.
     *
     * @param  array<string, mixed>  $body  Contextualized embeddings request body.
     * @return array<string, mixed>
     */
    public function createContextualizedEmbeddings(array $body): array
    {
        return $this->request('POST', '/contextualizedembeddings', $body);
    }

    /**
     * Create multimodal embeddings.
     *
     * @param  array<string, mixed>  $body  Multimodal embeddings request body.
     * @return array<string, mixed>
     */
    public function createMultimodalEmbeddings(array $body): array
    {
        return $this->request('POST', '/multimodalembeddings', $body);
    }

    /**
     * Rerank documents for a query.
     *
     * @param  array<string, mixed>  $body  Rerank request body.
     * @return array<string, mixed>
     */
    public function rerank(array $body): array
    {
        return $this->request('POST', '/rerank', $body);
    }

    /**
     * Upload a JSONL file for batch processing.
     *
     * @return array<string, mixed>
     */
    public function uploadFile(string $filename, string $content, string $purpose = 'batch'): array
    {
        $response = $this->multipartRequest('/files', $filename, $content, $purpose);

        return $response->json() ?? [];
    }

    /**
     * List uploaded files.
     *
     * @param  array<string, mixed>  $params  Query params: purpose, limit, order, after.
     * @return array<string, mixed>
     */
    public function listFiles(array $params = []): array
    {
        return $this->request('GET', '/files', $params);
    }

    /**
     * Retrieve file metadata.
     *
     * @return array<string, mixed>
     */
    public function retrieveFile(string $fileId): array
    {
        return $this->request('GET', '/files/' . rawurlencode($fileId));
    }

    /**
     * Retrieve file content as text or JSON.
     *
     * @return array<string, mixed>|string
     */
    public function retrieveFileContent(string $fileId, string $accept = 'text/plain'): array|string
    {
        $response = $this->rawRequest('GET', '/files/' . rawurlencode($fileId) . '/content', [], 60, [
            'Accept' => $accept,
        ]);

        return str_contains((string) $response->header('Content-Type'), 'application/json')
            ? ($response->json() ?? [])
            : $response->body();
    }

    /**
     * Delete a single file.
     *
     * @return array<string, mixed>
     */
    public function deleteFile(string $fileId): array
    {
        return $this->request('DELETE', '/files/' . rawurlencode($fileId));
    }

    /**
     * Bulk delete files.
     *
     * @param  array<int, string>  $fileIds  File IDs to delete.
     * @return array<string, mixed>
     */
    public function bulkDeleteFiles(array $fileIds): array
    {
        return $this->request('POST', '/files/delete', ['file_ids' => array_values($fileIds)]);
    }

    /**
     * Create a batch inference job.
     *
     * @param  array<string, mixed>  $body  Batch create request body.
     * @return array<string, mixed>
     */
    public function createBatch(array $body): array
    {
        return $this->request('POST', '/batches', $body);
    }

    /**
     * List batch jobs.
     *
     * @param  array<string, mixed>  $params  Query params: limit, after.
     * @return array<string, mixed>
     */
    public function listBatches(array $params = []): array
    {
        return $this->request('GET', '/batches', $params);
    }

    /**
     * Retrieve a batch job.
     *
     * @return array<string, mixed>
     */
    public function retrieveBatch(string $batchId): array
    {
        return $this->request('GET', '/batches/' . rawurlencode($batchId));
    }

    /**
     * Cancel a batch job.
     *
     * @return array<string, mixed>
     */
    public function cancelBatch(string $batchId): array
    {
        return $this->request('POST', '/batches/' . rawurlencode($batchId) . '/cancel');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Request query string or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], int $timeout = 60): array
    {
        $response = $this->rawRequest($method, $path, $data, $timeout);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Voyage AI API.
     *
     * @param  array<string, mixed>  $data  Request query string or JSON body.
     * @param  array<string, string>  $extraHeaders  Extra request headers.
     */
    private function rawRequest(string $method, string $path, array $data = [], int $timeout = 60, array $extraHeaders = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Voyage AI API key is not configured.');
        }

        $url = $this->baseUrl . $path;
        $headers = array_merge([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ], $extraHeaders);

        try {
            $http = Http::withHeaders($headers)->timeout($timeout);
            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('detail')
                    ?? $response->json('message')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error("Voyage AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Voyage AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Voyage AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Voyage AI API: {$e->getMessage()}");
        }
    }

    /**
     * Make a multipart upload request.
     */
    private function multipartRequest(string $path, string $filename, string $content, string $purpose): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Voyage AI API key is not configured.');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->timeout(120)
                ->attach('file', $content, $filename)
                ->post($this->baseUrl . $path, ['purpose' => $purpose]);

            if (!$response->successful()) {
                $error = $response->json('detail')
                    ?? $response->json('message')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error('Voyage AI API error: POST ' . $path, [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Voyage AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Voyage AI API upload connection error: POST ' . $path, [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Voyage AI API: {$e->getMessage()}");
        }
    }
}
