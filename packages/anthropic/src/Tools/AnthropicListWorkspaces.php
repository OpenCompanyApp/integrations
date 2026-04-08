<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Anthropic workspaces.
 *
 * Sends a GET request to /workspaces with optional pagination parameters.
 * Returns a paginated list of workspace resources.
 *
 * @see https://docs.anthropic.com/en/api/list-workspaces
 */
class AnthropicListWorkspaces implements Tool
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
        return 'anthropic_list_workspaces';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List Anthropic workspaces. Returns workspace identifiers, names, and configuration details.';
    }

    /**
     * Parameter schema for the list workspaces request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of workspaces to return per page (default: 20, max: 1000).'],
            'before_id' => ['type' => 'string', 'description' => 'Workspace ID used for cursor-based pagination — return workspaces before this ID.'],
            'after_id' => ['type' => 'string', 'description' => 'Workspace ID used for cursor-based pagination — return workspaces after this ID.'],
        ];
    }

    /**
     * Execute the list workspaces request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The paginated list of workspaces or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Anthropic integration is not configured.');
            }

            $params = [];

            $optionalKeys = ['limit', 'before_id', 'after_id'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listWorkspaces($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
