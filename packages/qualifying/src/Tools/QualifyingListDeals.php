<?php

namespace OpenCompany\Integrations\Qualifying\Tools;

use OpenCompany\Integrations\Qualifying\QualifyingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QualifyingListDeals implements Tool
{
    public function __construct(
        private QualifyingService $service,
    ) {}

    public function name(): string
    {
        return 'qualifying_list_deals';
    }

    public function description(): string
    {
        return 'List deals from Qualifying. Returns a paginated list of deals with their details. Optionally filter by stage to see deals in a specific pipeline stage (e.g., "lead", "qualified", "won", "lost").';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deals to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'stage' => ['type' => 'string', 'description' => 'Filter deals by pipeline stage (e.g., "lead", "qualified", "proposal", "won", "lost").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qualifying integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $stage = $args['stage'] ?? null;

            $result = $this->service->listDeals($limit, $page, $stage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
