<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_get_time_entry
 *
 * Gets details for a single Clockify time entry.
 */
class ClockifyGetTimeEntry implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_get_time_entry';
    }

    public function description(): string
    {
        return 'Get details for a single Clockify time entry by ID.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id'  => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'time_entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The time entry ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->getTimeEntry($args['workspace_id'], $args['time_entry_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
