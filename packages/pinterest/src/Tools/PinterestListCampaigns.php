<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ad campaigns for a Pinterest ad account.
 *
 * Retrieves campaigns for the specified ad account with optional
 * pagination via bookmark cursor and configurable page size.
 */
class PinterestListCampaigns implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_list_campaigns';
    }

    public function description(): string
    {
        return 'List ad campaigns for a Pinterest ad account. Requires an ad account ID. Supports pagination with bookmark cursor and page size.';
    }

    public function parameters(): array
    {
        return [
            'adAccountId' => ['type' => 'string', 'required' => true, 'description' => 'The ad account ID to list campaigns for.'],
            'bookmark' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of campaigns to return per page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            if (empty($args['adAccountId'])) {
                return ToolResult::error('An ad account ID is required.');
            }

            $result = $this->service->listCampaigns(
                adAccountId: $args['adAccountId'],
                bookmark: $args['bookmark'] ?? null,
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
