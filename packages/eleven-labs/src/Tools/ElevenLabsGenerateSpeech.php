<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate speech audio from text using an ElevenLabs voice.
 *
 * Submits text to the ElevenLabs text-to-speech API with a specified voice and model.
 * Returns base64-encoded audio data along with the content type. Optionally controls
 * voice stability and similarity boost for fine-tuning the output.
 */
class ElevenLabsGenerateSpeech implements Tool
{
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_generate_speech';
    }

    public function description(): string
    {
        return 'Generate speech audio from text using an ElevenLabs voice. Returns base64-encoded audio. Specify a voice ID and model, with optional stability and similarity boost settings.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The text to convert to speech.'],
            'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'The voice identifier to use for synthesis.'],
            'model_id' => ['type' => 'string', 'description' => 'The model ID (e.g., "eleven_multilingual_v2"). Defaults to "eleven_multilingual_v2".'],
            'stability' => ['type' => 'number', 'description' => 'Voice stability (0.0-1.0). Higher values produce more consistent, less expressive output.'],
            'similarity_boost' => ['type' => 'number', 'description' => 'Similarity boost (0.0-1.0). Higher values make the output closer to the original voice.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            if (empty($args['text'])) {
                return ToolResult::error('text is required.');
            }

            if (empty($args['voice_id'])) {
                return ToolResult::error('voice_id is required.');
            }

            $result = $this->service->generateSpeech(
                text: $args['text'],
                voiceId: $args['voice_id'],
                modelId: $args['model_id'] ?? 'eleven_multilingual_v2',
                stability: isset($args['stability']) ? (float) $args['stability'] : null,
                similarityBoost: isset($args['similarity_boost']) ? (float) $args['similarity_boost'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
