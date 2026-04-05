<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Fellow meetings with optional date filters and pagination.
 */
class FellowListMeetings implements Tool
{
    /**
     * Create a new FellowListMeetings tool instance.
     */
    public function __construct(
        private FellowService $service,
    ) {}

    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_list_meetings';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List meetings from Fellow. Supports date range filters and cursor-based pagination. Returns meeting IDs, titles, dates, attendees, and status.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'date_from' => ['type' => 'string', 'description' => 'Start date for filtering meetings (ISO 8601, e.g., "2026-01-01").'],
            'date_to' => ['type' => 'string', 'description' => 'End date for filtering meetings (ISO 8601, e.g., "2026-01-31").'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of meetings to return per page (default: 25).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fellow integration is not configured.');
            }

            $params = [];

            if (isset($args['date_from'])) {
                $params['date_from'] = $args['date_from'];
            }

            if (isset($args['date_to'])) {
                $params['date_to'] = $args['date_to'];
            }

            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listMeetings($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
