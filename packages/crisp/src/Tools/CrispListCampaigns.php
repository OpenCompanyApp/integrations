<?php

namespace OpenCompany\Integrations\Crisp\Tools;

use OpenCompany\Integrations\Crisp\CrispService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CrispListCampaigns — list marketing campaigns for the website.
 *
 * Returns a paginated list of campaigns with status, template info,
 * and delivery statistics.
 */
class CrispListCampaigns implements Tool
{
    public function __construct(
        private CrispService $service,
    ) {}

    public function name(): string
    {
        return 'crisp_list_campaigns';
    }

    public function description(): string
    {
        return 'List marketing campaigns from Crisp. Returns campaigns with status, template details, and delivery statistics. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (1-based). Default: 1.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of campaigns per page (max 100). Default: 25.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crisp integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listCampaigns($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
