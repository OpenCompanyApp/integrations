<?php

namespace OpenCompany\Integrations\Splitwise\Tools;

use OpenCompany\Integrations\Splitwise\SplitwiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * SplitwiseListGroups — List all groups the current user belongs to.
 *
 * Returns group names, member counts, and simplified balance information
 * for each group the authenticated user is part of.
 *
 * @see https://dev.splitwise.com/#get_groups
 */
class SplitwiseListGroups implements Tool
{
    /**
     * Create a new SplitwiseListGroups tool instance.
     *
     * @param  SplitwiseService  $service  The Splitwise API service.
     */
    public function __construct(
        private SplitwiseService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'splitwise_list_groups';
    }

    /**
     * Get the tool description shown to AI agents.
     *
     * @return string A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all groups the current user belongs to in Splitwise. Returns group names, member information, and balance summaries.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}> Parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list groups tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     * @return ToolResult The list of groups or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splitwise integration is not configured.');
            }

            $result = $this->service->listGroups();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
