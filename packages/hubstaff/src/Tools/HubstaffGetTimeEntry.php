<?php

namespace OpenCompany\Integrations\Hubstaff\Tools;

use OpenCompany\Integrations\Hubstaff\HubstaffService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HubstaffGetTimeEntry implements Tool
{
    public function __construct(
        private HubstaffService $service,
    ) {}

    public function name(): string
    {
        return 'hubstaff_get_time_entry';
    }

    public function description(): string
    {
        return 'Get details for a specific Hubstaff time entry by its ID. Returns the full time entry record including duration, notes, project, and user information.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The time entry ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hubstaff integration is not configured.');
            }

            $result = $this->service->getTimeEntry((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
