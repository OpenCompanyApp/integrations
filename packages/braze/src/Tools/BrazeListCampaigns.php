<?php

namespace OpenCompany\Integrations\Braze\Tools;

use OpenCompany\Integrations\Braze\BrazeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List marketing campaigns from Braze.
 *
 * Returns a paginated list of campaigns including names, IDs, and tags.
 * Use page and limit parameters to navigate through large result sets.
 *
 * @see https://www.braze.com/docs/api/endpoints/export/campaigns/get_campaigns/
 */
class BrazeListCampaigns implements Tool
{
    public function __construct(
        private BrazeService $service,
    ) {}

    public function name(): string
    {
        return 'braze_list_campaigns';
    }

    public function description(): string
    {
        return 'List marketing campaigns from Braze. Returns campaign IDs, names, tags, and creation dates. Use pagination to browse large numbers of campaigns.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-indexed, default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of campaigns to return per page (max 100, default: 100).'],
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

            $result = $this->service->listCampaigns($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
