<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_list_live_streams
 *
 * List live streams in Mux. Returns a paginated list of live streams
 * with their IDs, status, stream key, and playback information.
 */
class MuxListLiveStreams implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_list_live_streams';
    }

    public function description(): string
    {
        return 'List live streams in Mux. Returns a paginated list of live streams with their IDs, status, stream key, and playback information.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of live streams to return (1–100, default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page offset for pagination (0-indexed, default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mux integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 0;

            $result = $this->service->listLiveStreams($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
