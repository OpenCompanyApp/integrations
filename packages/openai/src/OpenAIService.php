<?php

namespace OpenCompany\Integrations\OpenAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the OpenAI REST API.
 *
 * Wraps HTTP calls to OpenAI endpoints for chat completions, embeddings,
 * images, audio, assistants, threads, runs, and file management.
 */
class OpenAIService
{
    private const BASE_URL = 'https://api.openai.com/v1';

    /**
     * @param  string  $apiKey  OpenAI API key (sk-...)
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Chat ────────────────────────────────────────────────

    /**
     * Create a chat completion.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function chatCompletion(array $data): array
    {
        return $this->request('POST', '/chat/completions', $data);
    }

    // ── Embeddings ───────────────────────────────────────────

    /**
     * Create an embedding vector.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createEmbedding(array $data): array
    {
        return $this->request('POST', '/embeddings', $data);
    }

    // ── Images ───────────────────────────────────────────────

    /**
     * Generate an image (DALL·E).
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createImage(array $data): array
    {
        return $this->request('POST', '/images/generations', $data);
    }

    // ── Audio ────────────────────────────────────────────────

    /**
     * Transcribe audio using Whisper.
     *
     * @param  string  $fileContent    Raw audio file bytes
     * @param  string  $filename       Filename with extension (e.g., "audio.mp3")
     * @param  string  $model          Model to use (e.g., "whisper-1")
     * @param  array<string, mixed>  $params  Additional parameters (language, response_format, etc.)
     * @return array<string, mixed>
     */
    public function transcribeAudio(string $fileContent, string $filename, string $model, array $params = []): array
    {
        return $this->requestMultipart('/audio/transcriptions', $fileContent, $filename, 'file', array_merge(['model' => $model], $params));
    }

    /**
     * Generate speech audio using TTS.
     *
     * Returns raw binary audio content.
     *
     * @param  array<string, mixed>  $data
     * @return string  Binary audio content
     */
    public function textToSpeech(array $data): string
    {
        return $this->requestBinary('POST', '/audio/speech', $data);
    }

    // ── Assistants ───────────────────────────────────────────

    /**
     * Create an assistant.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createAssistant(array $data): array
    {
        return $this->request('POST', '/assistants', $data, true);
    }

    /**
     * List assistants.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listAssistants(array $params = []): array
    {
        return $this->request('GET', '/assistants', $params, true);
    }

    // ── Threads ──────────────────────────────────────────────

    /**
     * Create a thread.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createThread(array $data = []): array
    {
        return $this->request('POST', '/threads', $data, true);
    }

    /**
     * Add a message to a thread.
     *
     * @param  string  $threadId
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function addMessageToThread(string $threadId, array $data): array
    {
        return $this->request('POST', "/threads/{$threadId}/messages", $data, true);
    }

    /**
     * List messages in a thread.
     *
     * @param  string  $threadId
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listThreadMessages(string $threadId, array $params = []): array
    {
        return $this->request('GET', "/threads/{$threadId}/messages", $params, true);
    }

    // ── Runs ─────────────────────────────────────────────────

    /**
     * Create a run on a thread.
     *
     * @param  string  $threadId
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createRun(string $threadId, array $data): array
    {
        return $this->request('POST', "/threads/{$threadId}/runs", $data, true);
    }

    /**
     * Get a run's status.
     *
     * @param  string  $threadId
     * @param  string  $runId
     * @return array<string, mixed>
     */
    public function getRun(string $threadId, string $runId): array
    {
        return $this->request('GET', "/threads/{$threadId}/runs/{$runId}", [], true);
    }

    // ── Files ────────────────────────────────────────────────

    /**
     * Upload a file to OpenAI.
     *
     * @param  string  $fileContent  Raw file bytes
     * @param  string  $filename     Filename with extension
     * @param  string  $purpose      Upload purpose (e.g., "assistants", "fine-tune")
     * @return array<string, mixed>
     */
    public function uploadFile(string $fileContent, string $filename, string $purpose): array
    {
        return $this->requestMultipart('/files', $fileContent, $filename, 'file', ['purpose' => $purpose]);
    }

    /**
     * List uploaded files.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listFiles(array $params = []): array
    {
        return $this->request('GET', '/files', $params);
    }

    // ── Models ───────────────────────────────────────────────

    /**
     * List available models.
     *
     * @return array<string, mixed>
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make a JSON API request to OpenAI.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $assistantApi = false): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('OpenAI API key is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ];

            if ($assistantApi) {
                $headers['OpenAI-Beta'] = 'assistants=v2';
            }

            $http = Http::withHeaders($headers)->timeout(120);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                Log::error("OpenAI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("OpenAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to OpenAI API: {$e->getMessage()}");
        }
    }

    /**
     * Make a multipart form-data request to OpenAI.
     *
     * @param  array<string, mixed>  $fields  Additional form fields
     * @return array<string, mixed>
     */
    private function requestMultipart(string $path, string $fileContent, string $filename, string $fieldName = 'file', array $fields = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('OpenAI API key is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->timeout(120);

            foreach ($fields as $key => $value) {
                $http = $http->attach($key, (string) $value);
            }

            $response = $http->attach($fieldName, $fileContent, $filename)->post($url);

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                Log::error("OpenAI API multipart error: POST {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("OpenAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenAI API connection error: POST {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to OpenAI API: {$e->getMessage()}");
        }
    }

    /**
     * Make a request that returns binary content (e.g., TTS).
     *
     * @param  array<string, mixed>  $data
     * @return string  Raw binary response body
     */
    private function requestBinary(string $method, string $path, array $data): string
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('OpenAI API key is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120);

            $response = match (strtoupper($method)) {
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $response->body();

                Log::error("OpenAI API binary error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("OpenAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->body();
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to OpenAI API: {$e->getMessage()}");
        }
    }
}
