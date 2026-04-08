<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_get_voice
 *
 * Retrieves detailed information about a single ElevenLabs voice,
 * including its settings, labels, and available models.
 */
class ElevenLabsGetVoice implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_get_voice';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ElevenLabs voice, including its settings, labels, and fine-tuning info.';
    }

    /**
     * @return array<string, array{type: string, required: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'The voice identifier to look up.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $result = $this->service->getVoice($args['voice_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
