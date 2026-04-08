<?php

namespace OpenCompany\Integrations\Clerk\Tools;

use OpenCompany\Integrations\Clerk\ClerkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClerkListOrganizations implements Tool
{
    /**
     * Create a new ClerkListOrganizations tool instance.
     */
    public function __construct(
        private ClerkService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'clerk_list_organizations';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List organizations from Clerk with optional filtering and pagination. Returns organization IDs, names, and metadata.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of organizations to return (default: 10, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of organizations to skip for pagination.'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter organizations by name.'],
        ];
    }

    /**
     * Execute the list organizations tool.
     *
     * @param  array  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clerk integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }

            $result = $this->service->listOrganizations($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
