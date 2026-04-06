<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deals from Freshsales CRM.
 *
 * Returns a paginated list of deals. Use this tool to browse deals
 * in the pipeline, track deal progress, or find deals by status.
 */
class FreshsalesListDeals implements Tool
{
    public function __construct(
        private FreshsalesService $service,
    ) {}

    public function name(): string
    {
        return 'freshsales_list_deals';
    }

    public function description(): string
    {
        return 'List deals from Freshsales CRM. Returns paginated results showing deal pipeline information.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of deals per page (default: 20, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;

            $result = $this->service->listDeals($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
