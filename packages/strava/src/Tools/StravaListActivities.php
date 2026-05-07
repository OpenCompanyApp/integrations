<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List activities for the authenticated Strava athlete.
 */
class StravaListActivities implements Tool
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
        return 'strava_list_activities';
    }

    /**
     * A description of what this tool does, shown to AI agents.
     */
    public function description(): string
    {
        return 'List recent activities for the authenticated Strava athlete. Supports pagination and date filtering with before/after Unix timestamps.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of activities per page (default: 30, max: 200).'],
            'before' => ['type' => 'integer', 'description' => 'Unix timestamp for activities before this time.'],
            'after' => ['type' => 'integer', 'description' => 'Unix timestamp for activities after this time.'],
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

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 30;
            $before = isset($args['before']) ? (int) $args['before'] : null;
            $after = isset($args['after']) ? (int) $args['after'] : null;

            $result = $this->service->listActivities($page, $perPage, $before, $after);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
