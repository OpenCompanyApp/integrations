<?php

namespace OpenCompany\Integrations\ElevenLabs\Tools;

use OpenCompany\Integrations\ElevenLabs\ElevenLabsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: elevenlabs_get_history
 *
 * Browses the generation history for the authenticated ElevenLabs account,
 * with optional pagination via page_size and start_after cursor.
 */
class ElevenLabsGetHistory implements Tool
{
    /**
     * @param ElevenLabsService $service The ElevenLabs API service instance.
     */
    public function __construct(
        private ElevenLabsService $service,
    ) {}

    public function name(): string
    {
        return 'elevenlabs_get_history';
    }

    public function description(): string
    {
        return 'Browse your ElevenLabs generation history. Returns a paginated list of past text-to-speech requests with metadata.';
    }

    /**
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [
            'page_size'   => ['type' => 'integer', 'description' => 'Number of history items per page (default: 20, max: 100).'],
            'start_after' => ['type' => 'integer', 'description' => 'History item ID to start after (for cursor-based pagination).'],
        ];
    }

    /**
     * Browse ElevenLabs generation history.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ElevenLabs integration is not configured.');
            }

            $pageSize   = isset($args['page_size']) ? (int) $args['page_size'] : 20;
            $startAfter = isset($args['start_after']) ? (int) $args['start_after'] : null;

            $result = $this->service->getHistory($pageSize, $startAfter);

            $history   = $result['history'] ?? $result;
            $lastIndex = $result['last_history_item_id'] ?? null;

            $response = [
                'history'   => is_array($history) ? $history : [],
                'itemCount' => is_array($history) ? count($history) : 0,
            ];

            if ($lastIndex !== null) {
                $response['last_history_item_id'] = $lastIndex;
                $response['hasMore'] = true;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
