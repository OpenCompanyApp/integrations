<?php

namespace OpenCompany\Integrations\Freshteam\Tools;

use OpenCompany\Integrations\Freshteam\FreshteamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshteamListCandidates implements Tool
{
    public function __construct(
        private FreshteamService $service,
    ) {}

    public function name(): string
    {
        return 'freshteam_list_candidates';
    }

    public function description(): string
    {
        return 'List recruitment candidates from Freshteam. Returns paginated candidate records with optional filtering by status.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter candidates by status (e.g., "active", "hired", "rejected", "on_hold").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshteam integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;
            $status = $args['status'] ?? null;

            $result = $this->service->listCandidates($page, $perPage, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
