<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to get details for a specific Upstash Redis database.
 *
 * Calls GET /v2/redis/databases/{id} on the Upstash Platform API
 * (https://api.upstash.com).
 */
class UpstashGetDatabase implements Tool
{
    /**
     * Create a new UpstashGetDatabase tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_get_database';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Upstash Redis database by ID, including endpoint, region, and usage stats.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The Upstash database ID.', 'required' => true],
        ];
    }

    /**
     * Execute the tool: fetch the database details.
     *
     * @param  array  $args  Tool arguments. Must contain 'id'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Upstash integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $database = $this->service->getDatabase($id);

            return ToolResult::success($database);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
