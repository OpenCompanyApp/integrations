<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service wrapper for the ElevenLabs Text-to-Speech API.
 *
 * Handles authentication via the `xi-api-key` header and provides methods
 * for text-to-speech synthesis, voice management, model listing, history
 * browsing, and user info retrieval.
 */
class ElevenLabsService
{
    /**
     * @param string $apiKey  ElevenLabs API key (sent as xi-api-key header).
     * @param string $baseUrl Base URL for the ElevenLabs API (default: https://api.elevenlabs.io/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.elevenlabs.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // ──────────────────────────────────────────────
    // Text-to-Speech
    // ──────────────────────────────────────────────

    /**
     * Synthesise speech from text using a specific voice.
     *
     * @param string $voiceId       The voice identifier.
     * @param string $text          The text to synthesise.
     * @param string $modelId       Model ID (e.g. "eleven_multilingual_v2").
     * @param array  $voiceSettings Optional voice settings (stability, similarity_boost, style, use_speaker_boost).
     * @return array{audio_base64: string, content_type: string, content_length: int}
     */
    public function textToSpeech(string $voiceId, string $text, string $modelId = 'eleven_multilingual_v2', array $voiceSettings = []): array
    {
        $body = [
            'text' => $text,
            'model_id' => $modelId,
        ];

        if (!empty($voiceSettings)) {
            $body['voice_settings'] = $voiceSettings;
        }

        $response = $this->rawRequest('POST', '/text-to-speech/' . urlencode($voiceId), $body);

        return [
            'audio_base64' => base64_encode($response->body()),
            'content_type' => $response->header('Content-Type') ?? 'audio/mpeg',
            'content_length' => strlen($response->body()),
        ];
    }

    // ──────────────────────────────────────────────
    // Voices
    // ──────────────────────────────────────────────

    /**
     * List all available voices.
     *
     * @return array The voices list from the API.
     */
    public function listVoices(): array
    {
        return $this->request('GET', '/voices');
    }

    /**
     * Get details for a single voice.
     *
     * @param string $voiceId The voice identifier.
     * @return array Voice details.
     */
    public function getVoice(string $voiceId): array
    {
        return $this->request('GET', '/voices/' . urlencode($voiceId));
    }

    /**
     * Create a new cloned voice.
     *
     * @param string $name        Name for the new voice.
     * @param array  $files       Array of file paths or base64-encoded audio samples.
     * @param string $description Optional description of the voice.
     * @return array The created voice data.
     */
    public function createVoice(string $name, array $files = [], string $description = ''): array
    {
        $body = [
            'name' => $name,
            'description' => $description,
        ];

        if (!empty($files)) {
            $body['files'] = $files;
        }

        return $this->request('POST', '/voices', $body);
    }

    /**
     * Delete a voice by its identifier.
     *
     * @param string $voiceId The voice identifier.
     */
    public function deleteVoice(string $voiceId): void
    {
        $this->request('DELETE', '/voices/' . urlencode($voiceId));
    }

    // ──────────────────────────────────────────────
    // Models
    // ──────────────────────────────────────────────

    /**
     * List all available TTS models.
     *
     * @return array The models list from the API.
     */
    public function getModels(): array
    {
        return $this->request('GET', '/models');
    }

    // ──────────────────────────────────────────────
    // History
    // ──────────────────────────────────────────────

    /**
     * Get the generation history.
     *
     * @param int   $pageSize Number of items per page.
     * @param int   $startAfter  Optional history item ID to start after (for cursor-based pagination).
     * @return array History items.
     */
    public function getHistory(int $pageSize = 20, ?int $startAfter = null): array
    {
        $params = ['page_size' => $pageSize];
        if ($startAfter !== null) {
            $params['start_after'] = $startAfter;
        }

        return $this->request('GET', '/history', $params);
    }

    // ──────────────────────────────────────────────
    // User
    // ──────────────────────────────────────────────

    /**
     * Get the current authenticated user's info and subscription details.
     *
     * @return array User data including subscription info.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ──────────────────────────────────────────────
    // Internal helpers
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method.
     * @param string $path   API path (appended to base URL).
     * @param array  $data   Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ElevenLabs API.
     *
     * @param string $method HTTP method.
     * @param string $path   API path (appended to base URL).
     * @param array  $data   Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or non-2xx response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('ElevenLabs API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'xi-api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->json('detail.message') ?? $response->body();
                Log::error("ElevenLabs API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("ElevenLabs API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ElevenLabs API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ElevenLabs API: {$e->getMessage()}");
        }
    }
}
