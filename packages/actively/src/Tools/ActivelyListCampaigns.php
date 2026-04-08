<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List campaigns for an organization in Actively.
 *
 * Returns a paginated list of campaigns associated with the specified organization.
 * Use the `limit` and `page` parameters to control pagination.
 */
class ActivelyListCampaigns implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_list_campaigns';
    }

    public function description(): string
    {
        return 'List campaigns for an organization in Actively. Returns campaign details including title, type, status, and date range. Paginate with limit and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'string', 'required' => true, 'description' => 'The organization UUID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of campaigns to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listCampaigns($args['org_id'], $limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
