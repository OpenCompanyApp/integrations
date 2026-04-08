<?php

namespace OpenCompany\Integrations\Mux\Tools;

use OpenCompany\Integrations\Mux\MuxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: mux_list_assets
 *
 * List video assets stored in Mux. Returns a paginated list of assets
 * with their IDs, status, duration, and playback information.
 */
class MuxListAssets implements Tool
{
    public function __construct(
        private MuxService $service,
    ) {}

    public function name(): string
    {
        return 'mux_list_assets';
    }

    public function description(): string
    {
        return 'List video assets stored in Mux. Returns a paginated list of assets with their IDs, status, duration, and playback information.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of assets to return (1–100, default: 25).'],
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

            $result = $this->service->listAssets($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
