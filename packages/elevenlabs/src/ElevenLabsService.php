<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the ElevenLabs API.
 *
 * Handles xi-api-key authentication, JSON and multipart requests, binary audio
 * responses, and normalized error reporting for all ElevenLabs tools.
 */
class ElevenLabsService
{
    /**
     * @param  string  $apiKey  ElevenLabs API key.
     * @param  string  $baseUrl  Base URL for the ElevenLabs API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.elevenlabs.io/v1',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->baseUrl);
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Synthesize speech from text using a specific voice.
     *
     * @param  string  $voiceId  The voice identifier.
     * @param  string  $text  The text to synthesize.
     * @param  string  $modelId  Model ID.
     * @param  array<string, mixed>  $voiceSettings  Optional voice settings.
     * @param  array<string, mixed>  $options  Optional body and query parameters.
     * @return array{audio_base64: string, content_type: string, content_length: int, character_cost?: string}
     */
    public function textToSpeech(string $voiceId, string $text, string $modelId = 'eleven_multilingual_v2', array $voiceSettings = [], array $options = []): array
    {
        $body = array_filter($options['body'] ?? [], static fn ($value): bool => $value !== null && $value !== '');
        $body['text'] = $text;
        $body['model_id'] = $modelId;

        if ($voiceSettings !== []) {
            $body['voice_settings'] = $voiceSettings;
        }

        return $this->binaryResponse($this->rawRequest(
            'POST',
            '/text-to-speech/' . rawurlencode($voiceId),
            $body,
            $options['query'] ?? []
        ));
    }

    /**
     * Synthesize speech with character timing information.
     *
     * @param  string  $voiceId  The voice identifier.
     * @param  array<string, mixed>  $body  Text-to-speech body.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array<string, mixed>
     */
    public function textToSpeechWithTimestamps(string $voiceId, array $body, array $query = []): array
    {
        return $this->request('POST', '/text-to-speech/' . rawurlencode($voiceId) . '/with-timestamps', $body, $query);
    }

    /**
     * Convert one voice in an audio file into another voice.
     *
     * @param  string  $voiceId  Target voice ID.
     * @param  string  $audioPath  Local audio file path.
     * @param  array<string, mixed>  $fields  Multipart form fields.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array{audio_base64: string, content_type: string, content_length: int, character_cost?: string}
     */
    public function speechToSpeech(string $voiceId, string $audioPath, array $fields = [], array $query = []): array
    {
        return $this->binaryResponse($this->multipartRequest(
            'POST',
            '/speech-to-speech/' . rawurlencode($voiceId),
            ['audio' => $audioPath],
            $fields,
            $query
        ));
    }

    /**
     * Transcribe speech using ElevenLabs Scribe.
     *
     * @param  string  $audioPath  Local audio or video file path.
     * @param  array<string, mixed>  $fields  Multipart form fields.
     * @return array<string, mixed>
     */
    public function speechToText(string $audioPath, array $fields = []): array
    {
        return $this->jsonResponse($this->multipartRequest('POST', '/speech-to-text', ['file' => $audioPath], $fields));
    }

    /**
     * Generate a sound effect from a text prompt.
     *
     * @param  array<string, mixed>  $body  Sound generation body.
     * @param  array<string, mixed>  $query  Optional query parameters.
     * @return array{audio_base64: string, content_type: string, content_length: int, character_cost?: string}
     */
    public function createSoundEffect(array $body, array $query = []): array
    {
        return $this->binaryResponse($this->rawRequest('POST', '/sound-generation', $body, $query));
    }

    /**
     * Remove background noise from an audio file.
     *
     * @param  string  $audioPath  Local audio file path.
     * @param  array<string, mixed>  $fields  Multipart form fields.
     * @return array{audio_base64: string, content_type: string, content_length: int, character_cost?: string}
     */
    public function isolateAudio(string $audioPath, array $fields = []): array
    {
        return $this->binaryResponse($this->multipartRequest('POST', '/audio-isolation', ['audio' => $audioPath], $fields));
    }

    /**
     * List audio isolation history.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAudioIsolationHistory(array $params = []): array
    {
        return $this->request('GET', '/audio-isolation/history', $params);
    }

    /**
     * List all available voices.
     *
     * @param  array<string, mixed>  $params  Query parameters such as show_legacy.
     * @return array<string, mixed>
     */
    public function listVoices(array $params = []): array
    {
        return $this->request('GET', '/voices', $params);
    }

    /**
     * Get details for a single voice.
     *
     * @param  string  $voiceId  The voice identifier.
     * @return array<string, mixed>
     */
    public function getVoice(string $voiceId): array
    {
        return $this->request('GET', '/voices/' . rawurlencode($voiceId));
    }

    /**
     * Get a voice's default settings.
     *
     * @param  string  $voiceId  The voice identifier.
     * @return array<string, mixed>
     */
    public function getVoiceSettings(string $voiceId): array
    {
        return $this->request('GET', '/voices/' . rawurlencode($voiceId) . '/settings');
    }

    /**
     * Edit a voice's default settings.
     *
     * @param  string  $voiceId  The voice identifier.
     * @param  array<string, mixed>  $body  Voice settings body.
     * @return array<string, mixed>
     */
    public function editVoiceSettings(string $voiceId, array $body): array
    {
        return $this->request('POST', '/voices/' . rawurlencode($voiceId) . '/settings/edit', $body);
    }

    /**
     * Create a cloned voice from uploaded samples.
     *
     * @param  string  $name  Voice name.
     * @param  array<int, string>  $files  Local audio sample paths.
     * @param  string  $description  Optional description.
     * @param  array<string, mixed>  $extra  Additional form fields.
     * @return array<string, mixed>
     */
    public function createVoice(string $name, array $files = [], string $description = '', array $extra = []): array
    {
        if ($files === []) {
            return $this->request('POST', '/voices/add', array_filter($extra + [
                'name' => $name,
                'description' => $description,
            ], static fn ($value): bool => $value !== null && $value !== ''));
        }

        return $this->jsonResponse($this->multipartRequest('POST', '/voices/add', ['files' => $files], $extra + [
            'name' => $name,
            'description' => $description,
        ]));
    }

    /**
     * Delete a voice by its identifier.
     *
     * @param  string  $voiceId  The voice identifier.
     * @return array<string, mixed>
     */
    public function deleteVoice(string $voiceId): array
    {
        return $this->request('DELETE', '/voices/' . rawurlencode($voiceId));
    }

    /**
     * List all available models.
     *
     * @return array<string, mixed>
     */
    public function getModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Get the generation history.
     *
     * @param  int  $pageSize  Number of items per page.
     * @param  string|null  $startAfter  Optional history item ID to start after.
     * @return array<string, mixed>
     */
    public function getHistory(int $pageSize = 20, ?string $startAfter = null): array
    {
        $params = ['page_size' => $pageSize];

        if ($startAfter !== null) {
            $params['start_after'] = $startAfter;
        }

        return $this->request('GET', '/history', $params);
    }

    /**
     * Get a history item by ID.
     *
     * @param  string  $historyItemId  History item ID.
     * @return array<string, mixed>
     */
    public function getHistoryItem(string $historyItemId): array
    {
        return $this->request('GET', '/history/' . rawurlencode($historyItemId));
    }

    /**
     * Get audio for a history item.
     *
     * @param  string  $historyItemId  History item ID.
     * @return array{audio_base64: string, content_type: string, content_length: int, character_cost?: string}
     */
    public function getHistoryItemAudio(string $historyItemId): array
    {
        return $this->binaryResponse($this->rawRequest('GET', '/history/' . rawurlencode($historyItemId) . '/audio'));
    }

    /**
     * Delete a history item.
     *
     * @param  string  $historyItemId  History item ID.
     * @return array<string, mixed>
     */
    public function deleteHistoryItem(string $historyItemId): array
    {
        return $this->request('DELETE', '/history/' . rawurlencode($historyItemId));
    }

    /**
     * Create a dubbing project from a source URL or multipart files.
     *
     * @param  array<string, mixed>  $fields  Dubbing form fields.
     * @param  array<string, string|array<int, string>>  $files  Optional local file fields.
     * @return array<string, mixed>
     */
    public function createDubbing(array $fields, array $files = []): array
    {
        if ($files !== []) {
            return $this->jsonResponse($this->multipartRequest('POST', '/dubbing', $files, $fields));
        }

        return $this->request('POST', '/dubbing', $fields);
    }

    /**
     * List dubbing projects.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDubbings(array $params = []): array
    {
        return $this->request('GET', '/dubbing', $params);
    }

    /**
     * Get a dubbing project.
     *
     * @param  string  $dubbingId  Dubbing project ID.
     * @return array<string, mixed>
     */
    public function getDubbing(string $dubbingId): array
    {
        return $this->request('GET', '/dubbing/' . rawurlencode($dubbingId));
    }

    /**
     * Delete a dubbing project.
     *
     * @param  string  $dubbingId  Dubbing project ID.
     * @return array<string, mixed>
     */
    public function deleteDubbing(string $dubbingId): array
    {
        return $this->request('DELETE', '/dubbing/' . rawurlencode($dubbingId));
    }

    /**
     * Get a dubbing transcript in a specific format.
     *
     * @param  string  $dubbingId  Dubbing project ID.
     * @param  string  $languageCode  Language code.
     * @param  string  $formatType  Transcript format: srt, webvtt, or json.
     * @return array<string, mixed>
     */
    public function getDubbingTranscript(string $dubbingId, string $languageCode, string $formatType = 'json'): array
    {
        return $this->request('GET', '/dubbing/' . rawurlencode($dubbingId) . '/transcripts/' . rawurlencode($languageCode) . '/format/' . rawurlencode($formatType));
    }

    /**
     * Get the current authenticated user's info and subscription details.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Get the current subscription.
     *
     * @return array<string, mixed>
     */
    public function getSubscription(): array
    {
        return $this->request('GET', '/user/subscription');
    }

    /**
     * Call an ElevenLabs GET endpoint relative to /v1.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call an ElevenLabs POST endpoint relative to /v1.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Call an ElevenLabs DELETE endpoint relative to /v1.
     *
     * @param  string  $path  Endpoint path.
     * @param  array<string, mixed>  $body  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $path, $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @param  array<string, mixed>  $query  Optional query params for non-GET requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        return $this->jsonResponse($this->rawRequest($method, $path, $data, $query));
    }

    /**
     * Make a raw JSON HTTP request to the ElevenLabs API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @param  array<string, mixed>  $query  Optional query params for non-GET requests.
     * @return Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        $this->assertConfigured();

        $url = $this->url($path, $query);

        try {
            $http = $this->jsonHttp();

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
            Log::error("ElevenLabs API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ElevenLabs API: {$e->getMessage()}");
        }
    }

    /**
     * Make a multipart HTTP request to the ElevenLabs API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, string|array<int, string>>  $files  File field map.
     * @param  array<string, mixed>  $fields  Form fields.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return Response
     */
    private function multipartRequest(string $method, string $path, array $files, array $fields = [], array $query = []): Response
    {
        $this->assertConfigured();

        try {
            $http = Http::withHeaders([
                'xi-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ])->timeout(120);

            foreach ($files as $field => $paths) {
                foreach ((array) $paths as $filePath) {
                    if (!is_file($filePath)) {
                        throw new \InvalidArgumentException("A valid file path is required for {$field}.");
                    }

                    $http = $http->attach($field, file_get_contents($filePath), basename($filePath));
                }
            }

            $response = match (strtoupper($method)) {
                'POST' => $http->post($this->url($path, $query), $this->stringifyMultipartFields($fields)),
                default => throw new \RuntimeException("Unsupported multipart HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ElevenLabs API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ElevenLabs API: {$e->getMessage()}");
        }
    }

    /**
     * Return parsed JSON from a response.
     *
     * @return array<string, mixed>
     */
    private function jsonResponse(Response $response): array
    {
        return $response->json() ?? [];
    }

    /**
     * Return base64-encoded binary audio plus metadata.
     *
     * @return array{audio_base64: string, content_type: string, content_length: int, character_cost?: string}
     */
    private function binaryResponse(Response $response): array
    {
        $body = $response->body();
        $result = [
            'audio_base64' => base64_encode($body),
            'content_type' => $response->header('Content-Type') ?? 'audio/mpeg',
            'content_length' => strlen($body),
        ];

        if ($response->header('character-cost') !== null) {
            $result['character_cost'] = (string) $response->header('character-cost');
        }

        return $result;
    }

    /**
     * Build the JSON HTTP client.
     */
    private function jsonHttp(): PendingRequest
    {
        return Http::withHeaders([
            'xi-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->timeout(60);
    }

    /**
     * Build a complete API URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function url(string $path, array $query = []): string
    {
        $url = $this->baseUrl . '/' . $this->normalizePath($path);
        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');

        if ($query !== []) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }

    /**
     * Normalize a relative API path and reject absolute URLs.
     */
    private function normalizePath(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('ElevenLabs API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use an ElevenLabs API path relative to the configured base URL.');
        }

        return $path;
    }

    /**
     * Normalize legacy host-only URLs to the ElevenLabs v1 API root.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');

        if (!str_ends_with($baseUrl, '/v1')) {
            $baseUrl .= '/v1';
        }

        return $baseUrl;
    }

    /**
     * Convert structured multipart fields to scalar form values.
     *
     * @param  array<string, mixed>  $fields  Multipart fields.
     * @return array<string, mixed>
     */
    private function stringifyMultipartFields(array $fields): array
    {
        $result = [];

        foreach ($fields as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $result[$key] = is_array($value) ? json_encode($value) : $value;
        }

        return $result;
    }

    /**
     * Ensure the API key exists.
     */
    private function assertConfigured(): void
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('ElevenLabs API key is not configured.');
        }
    }

    /**
     * Throw a normalized API exception.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $error = $response->json('error.message')
            ?? $response->json('detail.message')
            ?? $response->json('detail')
            ?? $response->body();

        Log::error("ElevenLabs API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("ElevenLabs API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
