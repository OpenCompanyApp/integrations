<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: toggl_get_time_entry
 *
 * Gets details for a single Toggl time entry.
 */
class TogglGetTimeEntry implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_get_time_entry';
    }

    public function description(): string
    {
        return 'Get details for a single Toggl time entry by ID.';
    }

    public function parameters(): array
    {
        return [
            'time_entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The time entry ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $result = $this->service->getTimeEntry($args['time_entry_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
