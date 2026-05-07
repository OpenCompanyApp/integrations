<?php

namespace OpenCompany\Integrations\Groq;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the official Groq REST APIs.
 *
 * Covers the OpenAI-compatible inference API plus Groq's fine-tuning beta API,
 * handling bearer authentication, JSON and multipart requests, and error parsing.
 */
class GroqService
{
    /**
     * @param  string  $apiKey  Groq API key for bearer authentication.
     * @param  string  $baseUrl  OpenAI-compatible Groq API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.groq.com/openai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List available models.
     *
     * @return array<string, mixed>
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Retrieve one model.
     *
     * @param  string  $model  Model identifier.
     * @return array<string, mixed>
     */
    public function getModel(string $model): array
    {
        return $this->request('GET', '/models/'.rawurlencode($model));
    }

    /**
     * Create a chat completion.
     *
     * @param  string  $model  Model identifier.
     * @param  array<int, array<string, mixed>>  $messages  Chat messages.
     * @param  array<string, mixed>  $options  Additional OpenAI-compatible options.
     * @return array<string, mixed>
     */
    public function createCompletion(string $model, array $messages, array $options = []): array
    {
        return $this->request('POST', '/chat/completions', array_merge([
            'model' => $model,
            'messages' => $messages,
        ], $options));
    }

    /**
     * Create a response through Groq's Responses beta endpoint.
     *
     * @param  array<string, mixed>  $payload  Official Responses API payload.
     * @return array<string, mixed>
     */
    public function createResponse(array $payload): array
    {
        return $this->request('POST', '/responses', $payload);
    }

    /**
     * Create an audio transcription.
     *
     * @param  array<string, mixed>  $payload  Transcription payload. Use file_path for multipart file upload.
     * @return array<string, mixed>
     */
    public function createTranscription(array $payload): array
    {
        return $this->audioRequest('/audio/transcriptions', $payload);
    }

    /**
     * Create an audio translation.
     *
     * @param  array<string, mixed>  $payload  Translation payload. Use file_path for multipart file upload.
     * @return array<string, mixed>
     */
    public function createTranslation(array $payload): array
    {
        return $this->audioRequest('/audio/translations', $payload);
    }

    /**
     * Create speech audio from text.
     *
     * @param  array<string, mixed>  $payload  Speech synthesis payload.
     * @return array<string, mixed>
     */
    public function createSpeech(array $payload): array
    {
        $response = $this->rawRequest('POST', '/audio/speech', $payload);

        return $this->bodyResult($response);
    }

    /**
     * Create a batch job from an uploaded JSONL file.
     *
     * @param  array<string, mixed>  $payload  Batch payload.
     * @return array<string, mixed>
     */
    public function createBatch(array $payload): array
    {
        return $this->request('POST', '/batches', $payload);
    }

    /**
     * Retrieve a batch by ID.
     *
     * @param  string  $batchId  Batch identifier.
     * @return array<string, mixed>
     */
    public function getBatch(string $batchId): array
    {
        return $this->request('GET', '/batches/'.rawurlencode($batchId));
    }

    /**
     * List batch jobs.
     *
     * @param  array<string, mixed>  $query  Cursor pagination filters.
     * @return array<string, mixed>
     */
    public function listBatches(array $query = []): array
    {
        return $this->request('GET', '/batches', $query);
    }

    /**
     * Cancel a batch by ID.
     *
     * @param  string  $batchId  Batch identifier.
     * @return array<string, mixed>
     */
    public function cancelBatch(string $batchId): array
    {
        return $this->request('POST', '/batches/'.rawurlencode($batchId).'/cancel');
    }

    /**
     * Upload a file for batch processing.
     *
     * @param  string  $filePath  Local path to the file to upload.
     * @param  string  $purpose  File purpose. Groq currently supports batch.
     * @return array<string, mixed>
     */
    public function uploadFile(string $filePath, string $purpose = 'batch'): array
    {
        $purpose = $purpose === '' ? 'batch' : $purpose;

        if (!is_file($filePath) || !is_readable($filePath)) {
            throw new RuntimeException('file_path must point to a readable local file.');
        }

        $response = $this->multipartRequest('/files', [
            'purpose' => $purpose,
        ], [
            'file' => [
                'contents' => file_get_contents($filePath),
                'name' => basename($filePath),
            ],
        ]);

        return $response->json() ?? [];
    }

    /**
     * List uploaded files.
     *
     * @param  array<string, mixed>  $query  Optional file listing filters.
     * @return array<string, mixed>
     */
    public function listFiles(array $query = []): array
    {
        return $this->request('GET', '/files', $query);
    }

    /**
     * Retrieve file metadata.
     *
     * @param  string  $fileId  File identifier.
     * @return array<string, mixed>
     */
    public function getFile(string $fileId): array
    {
        return $this->request('GET', '/files/'.rawurlencode($fileId));
    }

    /**
     * Delete an uploaded file.
     *
     * @param  string  $fileId  File identifier.
     * @return array<string, mixed>
     */
    public function deleteFile(string $fileId): array
    {
        return $this->request('DELETE', '/files/'.rawurlencode($fileId));
    }

    /**
     * Download file content.
     *
     * @param  string  $fileId  File identifier.
     * @return array<string, mixed>
     */
    public function downloadFile(string $fileId): array
    {
        $response = $this->rawRequest('GET', '/files/'.rawurlencode($fileId).'/content');

        return $this->bodyResult($response);
    }

    /**
     * List fine-tuning jobs from Groq's closed beta API.
     *
     * @return array<string, mixed>
     */
    public function listFineTunings(): array
    {
        return $this->platformRequest('GET', '/fine_tunings');
    }

    /**
     * Create a fine-tuning job.
     *
     * @param  array<string, mixed>  $payload  Fine-tuning payload.
     * @return array<string, mixed>
     */
    public function createFineTuning(array $payload): array
    {
        return $this->platformRequest('POST', '/fine_tunings', $payload);
    }

    /**
     * Retrieve one fine-tuning job.
     *
     * @param  string  $id  Fine-tuning identifier.
     * @return array<string, mixed>
     */
    public function getFineTuning(string $id): array
    {
        return $this->platformRequest('GET', '/fine_tunings/'.rawurlencode($id));
    }

    /**
     * Delete one fine-tuning job.
     *
     * @param  string  $id  Fine-tuning identifier.
     * @return array<string, mixed>
     */
    public function deleteFineTuning(string $id): array
    {
        return $this->platformRequest('DELETE', '/fine_tunings/'.rawurlencode($id));
    }

    /**
     * Groq does not document a conversation message listing endpoint.
     *
     * @return array<string, mixed>
     */
    public function listMessages(string $conversationId, int $limit = 20, ?string $after = null): array
    {
        throw new RuntimeException('Groq does not provide a documented conversation message listing endpoint. Use chat completions or responses with explicit message history.');
    }

    /**
     * Groq does not document a conversation message creation endpoint.
     *
     * @return array<string, mixed>
     */
    public function createMessage(string $conversationId, string $role, string $content): array
    {
        throw new RuntimeException('Groq does not provide a documented conversation message creation endpoint. Use chat completions or responses with explicit message history.');
    }

    /**
     * Groq does not document a current-user endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        throw new RuntimeException('Groq does not provide a documented current-user endpoint. Use list_models for a lightweight credential check.');
    }

    /**
     * Make a JSON API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a request to Groq's non-OpenAI platform API.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function platformRequest(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $this->platformBaseUrl());

        return $response->json() ?? [];
    }

    /**
     * Create transcription or translation, using multipart when file_path is provided.
     *
     * @param  array<string, mixed>  $payload  Audio request payload.
     * @return array<string, mixed>
     */
    private function audioRequest(string $path, array $payload): array
    {
        if (isset($payload['file_path']) && $payload['file_path'] !== '') {
            $filePath = (string) $payload['file_path'];
            unset($payload['file_path']);

            if (!is_file($filePath) || !is_readable($filePath)) {
                throw new RuntimeException('file_path must point to a readable local audio file.');
            }

            $response = $this->multipartRequest($path, $payload, [
                'file' => [
                    'contents' => file_get_contents($filePath),
                    'name' => basename($filePath),
                ],
            ]);

            return $response->json() ?? $this->bodyResult($response);
        }

        return $this->request('POST', $path, $payload);
    }

    /**
     * Make a raw JSON request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = [], ?string $baseUrl = null): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Groq API key is not configured.');
        }

        $method = strtoupper($method);
        $baseUrl ??= $this->baseUrl;
        $url = $baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(120);

            $response = match ($method) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->ensureSuccessful($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Groq API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Groq API: {$e->getMessage()}");
        }
    }

    /**
     * Make a multipart request with file attachments.
     *
     * @param  array<string, mixed>  $fields  Multipart form fields.
     * @param  array<string, array{contents: string|false, name: string}>  $files  Files keyed by form field.
     */
    private function multipartRequest(string $path, array $fields, array $files): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Groq API key is not configured.');
        }

        $http = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->apiKey,
            'Accept' => 'application/json',
        ])->timeout(120);

        foreach ($files as $field => $file) {
            if ($file['contents'] === false) {
                throw new RuntimeException("Could not read {$field} file contents.");
            }
            $http = $http->attach($field, $file['contents'], $file['name']);
        }

        $response = $http->post($this->baseUrl.$path, $fields);

        return $this->ensureSuccessful($response, 'POST', $path);
    }

    /**
     * Convert non-JSON response bodies into safe structured tool output.
     *
     * @return array<string, mixed>
     */
    private function bodyResult(Response $response): array
    {
        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return [
            'content_type' => $response->header('Content-Type'),
            'body_base64' => base64_encode($response->body()),
        ];
    }

    /**
     * Throw normalized exceptions for failed API responses.
     */
    private function ensureSuccessful(Response $response, string $method, string $path): Response
    {
        if ($response->successful()) {
            return $response;
        }

        $error = $response->json('error.message') ?? $response->json('error') ?? $response->body();
        Log::error("Groq API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException('Groq API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
    }

    /**
     * Derive Groq platform API base URL from the OpenAI-compatible base URL.
     */
    private function platformBaseUrl(): string
    {
        if (str_ends_with($this->baseUrl, '/openai/v1')) {
            return substr($this->baseUrl, 0, -strlen('/openai/v1')).'/v1';
        }

        return 'https://api.groq.com/v1';
    }
}
