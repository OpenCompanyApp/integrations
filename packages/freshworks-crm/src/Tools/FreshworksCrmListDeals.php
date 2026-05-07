<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Freshworks CRM deals.
 */
class FreshworksCrmListDeals implements Tool
{
    /**
     * @param  FreshworksCrmService  $service  The Freshworks CRM API client.
     */
    public function __construct(
        private FreshworksCrmService $service,
    ) {}

    public function name(): string
    {
        return 'freshworks_crm_list_deals';
    }

    public function description(): string
    {
        return 'List deals in Freshworks CRM. Returns paginated results with deal details. Optionally filter by deal stage.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of deals per page (default: 20, max: 100).'],
            'stage' => ['type' => 'integer', 'description' => 'Filter deals by stage ID (e.g., pipeline stage).'],
        ];
    }

    /**
     * List Freshworks CRM deals.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshworks CRM integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;
            $stage = isset($args['stage']) ? (int) $args['stage'] : null;

            $result = $this->service->listDeals($page, $perPage, $stage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
