<?php

namespace OpenCompany\Integrations\Autopilot\Tools;

use OpenCompany\Integrations\Autopilot\AutopilotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all journeys in the Autopilot account.
 */
class AutopilotListJourneys implements Tool
{
    public function __construct(
        private AutopilotService $service,
    ) {}

    public function name(): string
    {
        return 'autopilot_list_journeys';
    }

    public function description(): string
    {
        return 'List all journeys in your Autopilot account. Returns journey IDs and names.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Autopilot integration is not configured.');
            }

            $result = $this->service->listJourneys();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
