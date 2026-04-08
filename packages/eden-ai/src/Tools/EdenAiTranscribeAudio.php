<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Transcribe audio and video to text using AI models through Eden AI.
 *
 * Sends an audio transcription request to one or more AI providers via
 * the Eden AI aggregation API. Supports speech-to-text conversion with
 * multiple providers and language options.
 */
class EdenAiTranscribeAudio implements Tool
{
    public function __construct(
        private EdenAiService $service,
    ) {}

    public function name(): string
    {
        return 'edenai_transcribe_audio';
    }

    public function description(): string
    {
        return 'Transcribe audio or video to text using AI models via Eden AI. Supports providers like OpenAI (Whisper), Google Speech-to-Text, Amazon Transcribe, Microsoft Azure, and more. Provide audio as a URL or base64-encoded string.';
    }

    public function parameters(): array
    {
        return [
            'providers' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of transcription providers (e.g., "openai", "google", "amazon").'],
            'audio_url' => ['type' => 'string', 'description' => 'URL of the audio file to transcribe. Use this OR audio_base64, not both.'],
            'audio_base64' => ['type' => 'string', 'description' => 'Base64-encoded audio data. Use this OR audio_url, not both.'],
            'language' => ['type' => 'string', 'description' => 'Language code for the audio (e.g., "en", "fr", "de"). Omit for auto-detection.'],
            'speakers' => ['type' => 'integer', 'description' => 'Number of speakers in the audio for speaker diarization.'],
            'fallback_providers' => ['type' => 'string', 'description' => 'Comma-separated list of fallback providers if the primary fails.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
            }

            $body = [
                'providers' => $args['providers'],
            ];

            if (isset($args['audio_url'])) {
                $body['file_url'] = $args['audio_url'];
            } elseif (isset($args['audio_base64'])) {
                $body['base64_file'] = $args['audio_base64'];
            } else {
                return ToolResult::error('Either "audio_url" or "audio_base64" is required.');
            }

            if (isset($args['language'])) {
                $body['language'] = $args['language'];
            }

            if (isset($args['speakers'])) {
                $body['speakers'] = (int) $args['speakers'];
            }

            if (isset($args['fallback_providers'])) {
                $body['fallback_providers'] = $args['fallback_providers'];
            }

            $result = $this->service->transcribeAudio($body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the transcription response.
     *
     * @param  array<string, mixed>  $result  Raw API response.
     * @return array<string, mixed> Formatted response with transcription results.
     */
    private function formatResponse(array $result): array
    {
        $response = [];

        foreach ($result as $providerKey => $providerResult) {
            if (!is_array($providerResult)) {
                continue;
            }

            $entry = [
                'provider' => $providerKey,
            ];

            if (isset($providerResult['text'])) {
                $entry['transcription'] = $providerResult['text'];
            }

            if (isset($providerResult['status'])) {
                $entry['status'] = $providerResult['status'];
            }

            if (isset($providerResult['cost'])) {
                $entry['cost'] = $providerResult['cost'];
            }

            if (isset($providerResult['error'])) {
                $entry['error'] = $providerResult['error'];
            }

            $response[] = $entry;
        }

        return [
            'results' => $response,
            'providerCount' => count($response),
        ];
    }
}
