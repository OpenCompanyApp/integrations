<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deleted Phantombuster agents.
 */
class PhantombusterListDeletedAgents extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_list_deleted_agents';
    }

    public function description(): string
    {
        return 'List deleted Phantombuster agents in the current organization.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List deleted agents.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listDeletedAgents());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
