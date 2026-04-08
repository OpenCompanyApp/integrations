<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available ElevenLabs voices.
 *
 * Returns a paginated list of voices including their name, labels, preview URL,
 * and other metadata. Use this tool to discover available voices before generating
 * speech.
 */
class ElevenLabsListVoices implements Tool
{
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_list_voices';
    }

    public function description(): string
    {
        return 'List available ElevenLabs voices. Returns voice names, IDs, labels, and preview URLs. Use this to discover voices for text-to-speech generation.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of voices to return per page (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination, 1-based (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listVoices($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
