<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a relative Strava API DELETE endpoint.
 */
class StravaApiDelete extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_api_delete';
    }

    public function description(): string
    {
        return 'Call a relative Strava API DELETE path. Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Strava API path.'],
            'payload' => ['type' => 'object', 'description' => 'Optional JSON body.'],
        ];
    }

    /**
     * Execute a relative DELETE request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['path'])) {
                return ToolResult::error('path is required.');
            }

            return ToolResult::success($this->service->apiDelete((string) $args['path'], is_array($args['payload'] ?? null) ? $args['payload'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
