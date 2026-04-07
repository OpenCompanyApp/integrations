<?php

namespace OpenCompany\Integrations\Groq;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.groq.com/openai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
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
     * Create a chat completion.
     *
     * @param  string  $model  The model ID (e.g., "llama-3.3-70b-versatile").
     * @param  array  $messages  Array of message objects with "role" and "content".
     * @param  array  $options  Additional options (temperature, max_tokens, top_p, etc.).
     * @return array<string, mixed>
     */
    public function createCompletion(string $model, array $messages, array $options = []): array
    {
        $body = array_merge([
            'model' => $model,
            'messages' => $messages,
        ], $options);

        return $this->request('POST', '/chat/completions', $body);
    }

    /**
     * List messages in a conversation (Groq Cloud conversation API).
     *
     * @param  string  $conversationId  The conversation ID.
     * @param  int  $limit  Maximum number of messages to return.
     * @param  string|null  $after  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listMessages(string $conversationId, int $limit = 20, ?string $after = null): array
    {
        $params = ['limit' => $limit];
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', "/conversations/{$conversationId}/messages", $params);
    }

    /**
     * Create a message in a conversation (Groq Cloud conversation API).
     *
     * @param  string  $conversationId  The conversation ID.
     * @param  string  $role  The role of the message author (e.g., "user").
     * @param  string  $content  The message content.
     * @return array<string, mixed>
     */
    public function createMessage(string $conversationId, string $role, string $content): array
    {
        $body = [
            'role' => $role,
            'content' => $content,
        ];

        return $this->request('POST', "/conversations/{$conversationId}/messages", $body);
    }

    /**
     * List uploaded files.
     *
     * @param  string|null  $purpose  Filter by file purpose (e.g., "batch").
     * @param  int  $limit  Maximum number of files to return.
     * @param  string|null  $after  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listFiles(?string $purpose = null, int $limit = 20, ?string $after = null): array
    {
        $params = ['limit' => $limit];
        if ($purpose) {
            $params['purpose'] = $purpose;
        }
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/files', $params);
    }

    /**
     * Get details for a specific file.
     *
     * @param  string  $fileId  The file identifier.
     * @return array<string, mixed>
     */
    public function getFile(string $fileId): array
    {
        return $this->request('GET', "/files/{$fileId}");
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/models").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Groq API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Groq API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Groq API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Groq API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Groq API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Groq API: {$e->getMessage()}");
        }
    }
}
