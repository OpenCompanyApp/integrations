<?php

namespace OpenCompany\Integrations\AssemblyAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * AssemblyAI API service for speech-to-text transcription, file uploads, and account management.
 *
 * Handles authenticated HTTP requests to the AssemblyAI v2 REST API using a Bearer token.
 * Supports configurable base URL for custom endpoints.
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
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
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
     * @param  array  $options  Transcription options including 'audio_url' and optional settings
     *                           like language_code, speaker_labels, etc.
     * @return array The created transcript resource.
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
        return $this->request('GET', '/transcript/' . urlencode($id));
    }

    /**
     * List transcripts with optional filtering and pagination.
     *
     * @param  array  $params  Query parameters for filtering and pagination
     *                          (e.g., limit, status, created_on, after, etc.).
     * @return array Paginated list of transcript resources.
     *
     * @see https://www.assemblyai.com/docs/assemblyai-api#list-transcripts
     */
    public function listTranscripts(array $params = []): array
    {
        return $this->request('GET', '/transcripts', $params);
    }

    /**
     * Upload a local audio/video file for transcription.
     *
     * @param  string  $filePath  Absolute path to the file to upload.
     * @return array Upload response containing the upload URL.
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
     * Retrieve lemons (billing/usage information).
     *
     * @return array Lemon resources from the AssemblyAI API.
     *
     * @see https://www.assemblyai.com/docs/assemblyai-api
     */
    public function getLemons(): array
    {
        return $this->request('GET', '/lemons');
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array User profile data including email, plan, and usage.
     *
     * @see https://www.assemblyai.com/docs/assemblyai-api
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., '/transcript').
     * @param  array  $data  Query parameters or JSON body.
     * @return array Decoded JSON response.
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
    private function rawRequest(string $method, string $path, array $data = [], ?string $filePath = null): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('AssemblyAI API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120);

            // For file uploads, send raw binary with upload-specific headers
            if ($filePath !== null) {
                $fileContent = file_get_contents($filePath);
                if ($fileContent === false) {
                    throw new \RuntimeException("Failed to read file: {$filePath}");
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
                    default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
                };
            }

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("AssemblyAI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("AssemblyAI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("AssemblyAI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("AssemblyAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("AssemblyAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to AssemblyAI API: {$e->getMessage()}");
        }
    }
}
