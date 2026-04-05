<?php

namespace OpenCompany\Integrations\LinkedIn\Tools;

use OpenCompany\Integrations\LinkedIn\LinkedInService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list the authenticated user's 1st-degree LinkedIn connections.
 *
 * Returns a paginated list of the user's connections with available
 * profile information for each connection.
 */
class LinkedInListConnections implements Tool
{
    /**
     * Create a new LinkedInListConnections tool instance.
     *
     * @param  LinkedInService  $service  The LinkedIn API service.
     */
    public function __construct(
        private LinkedInService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'linkedin_list_connections';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return "List the authenticated user's 1st-degree LinkedIn connections. Returns a paginated list of connections with their profile information.";
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the user's connections.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $result = $this->service->listConnections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
