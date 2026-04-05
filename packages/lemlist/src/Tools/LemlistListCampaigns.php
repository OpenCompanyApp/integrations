<?php

namespace OpenCompany\Integrations\Lemlist\Tools;

use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List all outreach campaigns in Lemlist.
 *
 * Returns a list of campaigns with their IDs, names, statuses, and metadata.
 */
class LemlistListCampaigns implements Tool
{
    public function __construct(
        private LemlistService $service,
    ) {}

    public function name(): string
    {
        return 'lemlist_list_campaigns';
    }

    public function description(): string
    {
        return 'List all outreach campaigns in Lemlist. Returns campaign IDs, names, statuses, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by campaign status (e.g. "active", "draft", "paused", "completed").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of campaigns to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of campaigns to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemlist integration is not configured.');
            }

            $params = [];
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listCampaigns($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
