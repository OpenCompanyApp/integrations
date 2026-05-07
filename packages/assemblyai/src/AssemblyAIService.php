<?php

namespace OpenCompany\Integrations\AssemblyAI;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for AssemblyAI REST APIs.
 *
 * Handles authenticated requests for transcripts, uploads, streaming tokens, and LLM Gateway chat.
 *
 * @see https://www.assemblyai.com/docs/getting-started
 */
class AssemblyAIService
{
    /**
     * Create a new AssemblyAI service instance.
     *
     * @param  string  $apiKey  AssemblyAI API key for Bearer token authentication.
     * @param  string  $baseUrl  Base URL for the AssemblyAI API (default: https://api.assemblyai.com/v2).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.assemblyai.com/v2',
        private string $streamingBaseUrl = 'https://streaming.assemblyai.com',
        private string $llmGatewayBaseUrl = 'https://llm-gateway.assemblyai.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->streamingBaseUrl = rtrim($this->streamingBaseUrl, '/');
        $this->llmGatewayBaseUrl = rtrim($this->llmGatewayBaseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Submit a new transcription request with an audio URL.
     *
     * @param  array<string, mixed>  $options  Transcription options including audio_url and feature settings.
     * @return array<string, mixed> The created transcript resource.
     *
     * @see https://www.assemblyai.com/docs/getting-started/transcribe-an-audio-file
     */
    public function transcribe(array $options): array
    {
        return $this->request('POST', '/transcript', $options);
    }

    /**
     * Retrieve a transcript by its ID.
     *
     * @param  string  $id  The transcript ID returned by the transcribe endpoint.
     * @return array The transcript resource with status, text, and metadata.
     *
     * @see https://www.assemblyai.com/docs/getting-started/transcribe-an-audio-file
     */
    public function getTranscript(string $id): array
    {
        return $this->request('GET', '/transcript/'.rawurlencode($id));
    }

    /**
     * List transcripts with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters for pagination.
     * @return array<string, mixed> Paginated list of transcript resources.
     *
     * @see https://www.assemblyai.com/docs/assemblyai-api#list-transcripts
     */
    public function listTranscripts(array $params = []): array
    {
        return $this->request('GET', '/transcript', $params);
    }

    /**
     * Delete a transcript and its associated uploaded file data.
     *
     * @param  string  $id  Transcript ID.
     * @return array<string, mixed> Deleted transcript response.
     */
    public function deleteTranscript(string $id): array
    {
        return $this->request('DELETE', '/transcript/'.rawurlencode($id));
    }

    /**
     * Get semantic paragraphs for a completed transcript.
     *
     * @param  string  $id  Transcript ID.
     * @return array<string, mixed> Paragraph export response.
     */
    public function getParagraphs(string $id): array
    {
        return $this->request('GET', '/transcript/'.rawurlencode($id).'/paragraphs');
    }

    /**
     * Get semantic sentences for a completed transcript.
     *
     * @param  string  $id  Transcript ID.
     * @return array<string, mixed> Sentence export response.
     */
    public function getSentences(string $id): array
    {
        return $this->request('GET', '/transcript/'.rawurlencode($id).'/sentences');
    }

    /**
     * Get subtitles for a completed transcript.
     *
     * @param  string  $id  Transcript ID.
     * @param  string  $format  Subtitle format, either srt or vtt.
     * @param  array<string, mixed>  $params  Query parameters such as chars_per_caption.
     * @return array{format: string, content: string}
     */
    public function getSubtitles(string $id, string $format = 'srt', array $params = []): array
    {
        $format = strtolower($format);
        if (! in_array($format, ['srt', 'vtt'], true)) {
            throw new RuntimeException('Subtitle format must be either srt or vtt.');
        }

        $response = $this->rawRequest('GET', '/transcript/'.rawurlencode($id).'/'.$format, $params);

        return [
            'format' => $format,
            'content' => $response->body(),
        ];
    }

    /**
     * Get a redacted audio URL for a completed transcript.
     *
     * @param  string  $id  Transcript ID.
     * @return array<string, mixed> Redacted audio response.
     */
    public function getRedactedAudio(string $id): array
    {
        return $this->request('GET', '/transcript/'.rawurlencode($id).'/redacted-audio');
    }

    /**
     * Upload a local audio/video file for transcription.
     *
     * @param  string  $filePath  Absolute path to the file to upload.
     * @return array<string, mixed> Upload response containing the upload URL.
     *
     * @see https://www.assemblyai.com/docs/getting-started/upload-a-file
     */
    public function upload(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("File not found: {$filePath}");
        }

        $response = $this->rawRequest('POST', '/upload', [], $filePath);

        return $response->json() ?? [];
    }

    /**
     * Generate a temporary token for Streaming Speech-to-Text.
     *
     * @param  int  $expiresInSeconds  Token lifetime from 1 to 600 seconds.
     * @param  int|null  $maxSessionDurationSeconds  Optional max streaming session duration.
     * @return array<string, mixed> Temporary streaming token response.
     */
    public function createStreamingToken(int $expiresInSeconds, ?int $maxSessionDurationSeconds = null): array
    {
        $params = ['expires_in_seconds' => $expiresInSeconds];
        if ($maxSessionDurationSeconds !== null) {
            $params['max_session_duration_seconds'] = $maxSessionDurationSeconds;
        }

        return $this->request('GET', $this->streamingBaseUrl.'/v3/token', $params);
    }

    /**
     * Create an AssemblyAI LLM Gateway chat completion.
     *
     * @param  array<string, mixed>  $payload  Chat completion payload.
     * @return array<string, mixed> LLM Gateway response.
     */
    public function chatCompletion(array $payload): array
    {
        return $this->request('POST', $this->llmGatewayBaseUrl.'/chat/completions', $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., '/transcript').
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed> Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the AssemblyAI API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Request data (query params for GET, JSON body for POST/PUT/DELETE).
     * @param  string|null  $filePath  Optional file path for upload requests.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = [], ?string $filePath = null): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('AssemblyAI API key is not configured.');
        }

        $url = str_starts_with($path, 'http') ? $path : $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120);

            if ($filePath !== null) {
                $fileContent = file_get_contents($filePath);
                if ($fileContent === false) {
                    throw new RuntimeException("Failed to read file: {$filePath}");
                }

                $http = Http::withHeaders([
                    'Authorization' => $this->apiKey,
                    'Content-Type' => 'application/octet-stream',
                ])->timeout(300)->withBody($fileContent, 'application/octet-stream');

                $response = $http->post($url);
            } else {
                $response = match (strtoupper($method)) {
                    'GET' => $http->get($url, $data),
                    'POST' => $http->post($url, $data),
                    'PUT' => $http->put($url, $data),
                    'DELETE' => $http->delete($url, $data),
                    default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
                };
            }

            if (! $response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("AssemblyAI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("AssemblyAI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('error.message') ?? $body;
                Log::error("AssemblyAI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("AssemblyAI API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("AssemblyAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to AssemblyAI API: {$e->getMessage()}");
        }
    }
}
