<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_text_to_speech
 *
 * Converts text into speech audio using a specified ElevenLabs voice and model.
 * Returns a base64-encoded audio payload along with content type and size metadata.
 */
class ElevenLabsTextToSpeech implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_text_to_speech';
    }

    public function description(): string
    {
        return 'Convert text to speech audio using an ElevenLabs voice. Returns base64-encoded audio. Choose a voice ID and model ID to control the output.';
    }

    /**
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'The voice identifier (use list_voices to discover available voices).'],
            'text'     => ['type' => 'string', 'required' => true, 'description' => 'The text to convert to speech.'],
            'model_id' => ['type' => 'string', 'description' => 'Model ID to use (e.g., "eleven_multilingual_v2", "eleven_monolingual_v1", "eleven_turbo_v2_5"). Defaults to "eleven_multilingual_v2".'],
            'stability'       => ['type' => 'number', 'description' => 'Voice stability (0.0–1.0). Higher values reduce randomness.'],
            'similarity_boost' => ['type' => 'number', 'description' => 'Voice similarity boost (0.0–1.0). Higher values enforce voice similarity.'],
            'style'           => ['type' => 'number', 'description' => 'Style exaggeration (0.0–1.0). Higher values increase expressiveness.'],
            'use_speaker_boost' => ['type' => 'boolean', 'description' => 'Enable speaker boost for enhanced clarity.'],
        ];
    }

    /**
     * Generate speech audio from text.
     *
     * @param  array<string, mixed>  $args  Tool arguments (voice_id, text, model_id, voice settings).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $voiceId = trim((string) ($args['voice_id'] ?? ''));
            if ($voiceId === '') {
                return ToolResult::error('voice_id is required.');
            }

            $text = trim((string) ($args['text'] ?? ''));
            if ($text === '') {
                return ToolResult::error('text is required.');
            }

            $modelId  = $args['model_id'] ?? 'eleven_multilingual_v2';

            $voiceSettings = [];
            if (isset($args['stability'])) {
                $voiceSettings['stability'] = (float) $args['stability'];
            }
            if (isset($args['similarity_boost'])) {
                $voiceSettings['similarity_boost'] = (float) $args['similarity_boost'];
            }
            if (isset($args['style'])) {
                $voiceSettings['style'] = (float) $args['style'];
            }
            if (isset($args['use_speaker_boost'])) {
                $voiceSettings['use_speaker_boost'] = (bool) $args['use_speaker_boost'];
            }

            $result = $this->service->textToSpeech($voiceId, $text, $modelId, $voiceSettings);

            return ToolResult::success([
                'audio' => $result,
                'message' => sprintf(
                    'Generated %d bytes of audio (%s) using voice %s and model %s.',
                    $result['content_length'],
                    $result['content_type'],
                    $voiceId,
                    $modelId
                ),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
