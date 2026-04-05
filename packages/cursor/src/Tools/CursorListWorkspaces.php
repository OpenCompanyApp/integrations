<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\Integrations\Cursor\CursorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Cursor workspaces accessible to the authenticated user.
 *
 * Returns workspace identifiers and metadata that can be used with other
 * Cursor tools such as get_workspace, list_team_members, and list_extensions.
 */
class CursorListWorkspaces implements Tool
{
    public function __construct(
        private CursorService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cursor_list_workspaces';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all Cursor workspaces accessible to the authenticated user. Returns workspace IDs you can use with other Cursor tools.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, description?: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
