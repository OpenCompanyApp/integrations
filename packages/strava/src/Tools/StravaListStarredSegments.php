<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List starred Strava segments.
 */
class StravaListStarredSegments extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_list_starred_segments';
    }

    public function description(): string
    {
        return 'List starred segments for the authenticated Strava athlete.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
        ];
    }

    /**
     * List starred segments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listStarredSegments(
                isset($args['page']) ? (int) $args['page'] : 1,
                isset($args['per_page']) ? (int) $args['per_page'] : 30,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
