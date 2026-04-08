<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available ElevenLabs models.
 *
 * Returns a paginated list of models including text-to-speech, sound generation,
 * and other model types with their capabilities and supported languages.
 */
class ElevenLabsListModels implements Tool
{
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_list_models';
    }

    public function description(): string
    {
        return 'List available ElevenLabs models. Returns model IDs, names, descriptions, and capabilities. Use this to find the right model for speech or sound generation.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of models to return per page (default: 20).'],
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

            $result = $this->service->listModels($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
