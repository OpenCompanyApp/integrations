<?php

namespace OpenCompany\Integrations\CalCom\Tools;

use OpenCompany\Integrations\CalCom\CalComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List event types from Cal.com v2.
 *
 * Returns available event types (booking link templates) with optional
 * filtering by team and pagination support.
 *
 * @see https://developer.cal.com/api/endpoints/event-types
 */
class CalComListEventTypes implements Tool
{
    public function __construct(
        private CalComService $service,
    ) {}

    public function name(): string
    {
        return 'cal_com_list_event_types';
    }

    public function description(): string
    {
        return 'List available event types (booking link templates) from Cal.com. Supports filtering by team and pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of event types to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
            'teamId' => ['type' => 'integer', 'description' => 'Filter event types belonging to a specific team by its ID.'],
        ];
    }

    /**
     * Execute the tool — list event types from Cal.com.
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
            $teamId = isset($args['teamId']) ? (int) $args['teamId'] : null;

            $result = $this->service->listEventTypes($limit, $page, $teamId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
