<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Datadog monitors with optional filtering.
 *
 * Supports filtering by monitor name and tags, with pagination.
 */
class DatadogListMonitors implements Tool
{
    /**
     * Create a new DatadogListMonitors tool instance.
     *
     * @param  DatadogService  $service  The Datadog API service
     */
    public function __construct(
        private DatadogService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'datadog_list_monitors';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Datadog monitors. Optionally filter by name or tags. Returns monitor IDs, names, types, states, and query definitions.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Filter monitors by name (substring match).'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated list of tags to filter by (e.g., "env:production,service:api").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 0).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of monitors per page (default: 30).'],
        ];
    }

    /**
     * Execute the tool and return the list of monitors.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $params = [];

            if (isset($args['name'])) {
                $params['name'] = $args['name'];
            }

            if (isset($args['tags'])) {
                $params['tags'] = $args['tags'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }

            $result = $this->service->listMonitors($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
