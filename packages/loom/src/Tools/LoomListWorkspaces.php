<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workspaces accessible to the authenticated user.
 *
 * Returns workspace names, IDs, member counts, and other metadata
 * for all Loom workspaces the user has access to.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomListWorkspaces implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_list_workspaces';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List all Loom workspaces accessible to the authenticated user, including workspace names and member information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list workspaces API call.
     *
     * @param  array<string, mixed>  $args  No parameters required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loom integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
