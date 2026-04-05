<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workspaces accessible to the authenticated Tally user.
 *
 * Returns workspace names, IDs, and member information.
 */
class TallyListWorkspaces implements Tool
{
    public function __construct(
        private TallyService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'tally_list_workspaces';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all workspaces accessible to the authenticated Tally user. Returns workspace names, IDs, and member information.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, string>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list_workspaces tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
