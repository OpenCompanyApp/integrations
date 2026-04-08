<?php

namespace OpenCompany\Integrations\Litmos\Tools;

use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List teams in the Litmos LMS.
 *
 * Supports pagination.
 */
class LitmosListTeams implements Tool
{
    public function __construct(
        private LitmosService $service,
    ) {}

    public function name(): string
    {
        return 'litmos_list_teams';
    }

    public function description(): string
    {
        return 'List teams in your Litmos organization. Returns team IDs, names, and description. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of teams to return per page (default: 100, max: 1000).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Litmos integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listTeams($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
