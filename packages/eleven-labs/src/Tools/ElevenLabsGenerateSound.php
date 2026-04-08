<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate a sound effect from a text description.
 *
 * Submits a text prompt to the ElevenLabs sound generation API. Returns
 * base64-encoded audio data along with the content type.
 */
class ElevenLabsGenerateSound implements Tool
{
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_generate_sound';
    }

    public function description(): string
    {
        return 'Generate a sound effect from a text description using ElevenLabs. Returns base64-encoded audio. Describe the sound you want (e.g., "thunder rumbling in the distance").';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Description of the sound effect to generate.'],
            'model_id' => ['type' => 'string', 'description' => 'The model ID (e.g., "eleven_sound_generation_v1"). Defaults to "eleven_sound_generation_v1".'],
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

            $result = $this->service->generateSound(
                text: $args['text'],
                modelId: $args['model_id'] ?? 'eleven_sound_generation_v1',
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
