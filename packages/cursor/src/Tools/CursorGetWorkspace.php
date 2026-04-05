<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\Integrations\Cursor\CursorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Cursor workspace.
 *
 * Retrieves the full workspace object including name, settings, and other
 * metadata for the given workspace identifier.
 */
class CursorGetWorkspace implements Tool
{
    public function __construct(
        private CursorService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cursor_get_workspace';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Cursor workspace by its ID.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace identifier.'],
        ];
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

            $workspaceId = $args['workspace_id'] ?? '';
            if (empty($workspaceId)) {
                return ToolResult::error('workspace_id is required.');
            }

            $result = $this->service->getWorkspace($workspaceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
