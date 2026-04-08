<?php

namespace OpenCompany\Integrations\CalCom\Tools;

use OpenCompany\Integrations\CalCom\CalComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List teams from Cal.com v2.
 *
 * Returns teams in the authenticated user's Cal.com organization
 * with optional pagination support.
 *
 * @see https://developer.cal.com/api/endpoints/teams
 */
class CalComListTeams implements Tool
{
    public function __construct(
        private CalComService $service,
    ) {}

    public function name(): string
    {
        return 'cal_com_list_teams';
    }

    public function description(): string
    {
        return 'List teams in your Cal.com organization. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of teams to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
        ];
    }

    /**
     * Execute the tool — list teams from Cal.com.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $page = isset($args['page']) ? (int) $args['page'] : null;

            $result = $this->service->listTeams($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
