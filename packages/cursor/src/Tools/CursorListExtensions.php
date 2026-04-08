<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\Integrations\Cursor\CursorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all extensions installed in a Cursor workspace.
 *
 * Returns a list of extension objects including identifiers, names,
 * and version information for the specified workspace.
 */
class CursorListExtensions implements Tool
{
    public function __construct(
        private CursorService $service,
    ) {}

    /**
     * Get the tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cursor_list_extensions';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all extensions installed in a Cursor workspace. Returns extension names, identifiers, and versions.';
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

            $result = $this->service->listExtensions($workspaceId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
