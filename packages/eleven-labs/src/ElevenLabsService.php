<?php

namespace OpenCompany\Integrations\ElevenLabs;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ElevenLabsService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.elevenlabs.io',
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
     * List available voices.
     *
     * @param  int  $limit  Maximum number of voices to return per page.
     * @param  int  $page   Page number (1-based).
     * @return array<string, mixed>
     */
    public function listVoices(int $limit = 20, int $page = 1): array
    {
        return $this->request('GET', '/v1/voices', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get details for a single voice.
     *
     * @param  string  $voiceId  The unique voice identifier.
     * @return array<string, mixed>
     */
    public function getVoice(string $voiceId): array
    {
        return $this->request('GET', '/v1/voices/' . urlencode($voiceId));
    }

    /**
     * Generate speech from text using a specific voice.
     *
     * Returns the raw audio binary content.
     *
     * @param  string  $text             The text to synthesize.
     * @param  string  $voiceId          The voice identifier.
     * @param  string  $modelId          The model identifier (e.g., "eleven_multilingual_v2").
     * @param  float|null  $stability       Voice stability (0.0 - 1.0).
     * @param  float|null  $similarityBoost Similarity boost (0.0 - 1.0).
     * @return array{audio: string, content_type: string}
     */
    public function generateSpeech(
        string $text,
        string $voiceId,
        string $modelId = 'eleven_multilingual_v2',
        ?float $stability = null,
        ?float $similarityBoost = null,
    ): array {
        $body = [
            'text' => $text,
            'model_id' => $modelId,
        ];

        if ($stability !== null || $similarityBoost !== null) {
            $body['voice_settings'] = array_filter([
                'stability' => $stability,
                'similarity_boost' => $similarityBoost,
            ], fn ($v) => $v !== null);
        }

        $response = $this->rawRequest(
            'POST',
            '/v1/text-to-speech/' . urlencode($voiceId),
            $body,
        );

        return [
            'audio' => base64_encode($response->body()),
            'content_type' => $response->header('Content-Type') ?? 'audio/mpeg',
        ];
    }

    /**
     * Generate a sound effect from a text prompt.
     *
     * Returns the raw audio binary content.
     *
     * @param  string  $text     Description of the sound to generate.
     * @param  string  $modelId  The model identifier (e.g., "eleven_sound_generation_v1").
     * @return array{audio: string, content_type: string}
     */
    public function generateSound(
        string $text,
        string $modelId = 'eleven_sound_generation_v1',
    ): array {
        $body = [
            'text' => $text,
            'model_id' => $modelId,
        ];

        $response = $this->rawRequest('POST', '/v1/sound-generation', $body);

        return [
            'audio' => base64_encode($response->body()),
            'content_type' => $response->header('Content-Type') ?? 'audio/mpeg',
        ];
    }

    /**
     * List available models.
     *
     * @param  int  $limit  Maximum number of models to return per page.
     * @param  int  $page   Page number (1-based).
     * @return array<string, mixed>
     */
    public function listModels(int $limit = 20, int $page = 1): array
    {
        return $this->request('GET', '/v1/models', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get the current user's subscription and usage information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ElevenLabs API.
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
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("ElevenLabs API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ElevenLabs API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ElevenLabs API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
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
