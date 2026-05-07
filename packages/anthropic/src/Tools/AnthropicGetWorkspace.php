<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Anthropic organization workspace.
 *
 * Sends a GET request to /organizations/workspaces/{id} through the Admin API.
 *
 * @see https://docs.anthropic.com/en/api/admin-api/workspaces/get-workspace
 */
class AnthropicGetWorkspace implements Tool
{
    /**
     * @param  AnthropicService  $service  The Anthropic service instance.
     */
    public function __construct(
        private AnthropicService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'anthropic_get_workspace';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific Anthropic organization workspace. Requires an Admin API key.';
    }

    /**
     * Parameter schema for the get workspace request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace identifier.'],
        ];
    }

    /**
     * Execute the get workspace request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The workspace resource or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isAdminConfigured()) {
                return ToolResult::error('Anthropic Admin API key is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Workspace ID is required.');
            }

            $result = $this->service->getWorkspace($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
