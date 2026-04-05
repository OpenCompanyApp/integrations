<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaListActivities implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_list_activities';
    }

    public function description(): string
    {
        return 'List recent activities for the authenticated Strava athlete. Returns activity summaries including type, distance, time, and date.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of activities per page (default: 30, max: 200).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 30;

            $result = $this->service->listActivities($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
