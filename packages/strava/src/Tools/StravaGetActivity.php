<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaGetActivity implements Tool
{
    /**
     * @param  StravaService  $service  The Strava service instance.
     */
    public function __construct(
        private StravaService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'strava_get_activity';
    }

    /**
     * A description of what this tool does, shown to AI agents.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Strava activity, including distance, pace, elevation, and splits.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the activity to retrieve.'],
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
                return ToolResult::error('Strava integration is not configured.');
            }

            if (empty($args['activity_id'])) {
                return ToolResult::error('activity_id is required.');
            }

            $result = $this->service->getActivity((int) $args['activity_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
