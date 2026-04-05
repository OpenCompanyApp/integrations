<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaGetActivity implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_get_activity';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Strava activity by ID, including splits, segments, maps, and metrics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The activity ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Activity ID is required.');
            }

            $result = $this->service->getActivity((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
