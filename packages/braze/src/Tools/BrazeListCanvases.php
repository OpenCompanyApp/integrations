<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List canvases from Braze.
 *
 * Returns a paginated list of canvases (multi-step customer journeys)
 * including names, IDs, tags, and creation dates.
 *
 * @see https://www.braze.com/docs/api/endpoints/export/canvas/get_canvas/
 */
class BrazeListCanvases implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_list_canvases';
    }

    public function description(): string
    {
        return 'List canvases (multi-step customer journeys) from Braze. Returns canvas IDs, names, tags, and creation dates. Use pagination to browse large result sets.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-indexed, default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of canvases to return per page (max 100, default: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braze integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $result = $this->service->listCanvases($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
