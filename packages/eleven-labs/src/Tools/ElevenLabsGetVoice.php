<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific ElevenLabs voice.
 *
 * Returns full metadata for a single voice including its name, labels, description,
 * available model IDs, and preview audio URL.
 */
class ElevenLabsGetVoice implements Tool
{
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_get_voice';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific ElevenLabs voice by its ID, including name, labels, description, and preview URL.';
    }

    public function parameters(): array
    {
        return [
            'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique voice identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            if (empty($args['voice_id'])) {
                return ToolResult::error('voice_id is required.');
            }

            $result = $this->service->getVoice($args['voice_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
