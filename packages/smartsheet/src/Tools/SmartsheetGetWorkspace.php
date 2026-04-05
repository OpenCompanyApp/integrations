<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific Smartsheet workspace by ID, including its sheets and reports.
 */
class SmartsheetGetWorkspace implements Tool
{
    /**
     * Create a new SmartsheetGetWorkspace tool instance.
     *
     * @param SmartsheetService $service The Smartsheet API client.
     */
    public function __construct(private SmartsheetService $service) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'smartsheet_get_workspace';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Get a specific Smartsheet workspace by ID, including its sheets, reports, and other contents.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'workspace_id' => [
                'type' => 'integer',
                'description' => 'The unique identifier of the workspace to retrieve.',
                'required' => true,
            ],
        ];
    }

    /**
     * Execute the get workspace tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'workspace_id'.
     * @return ToolResult The result containing the workspace data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Smartsheet integration is not configured.');
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
