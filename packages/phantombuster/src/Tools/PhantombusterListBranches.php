<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Phantombuster script branches.
 */
class PhantombusterListBranches extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_list_branches';
    }

    public function description(): string
    {
        return 'List script branches in the current Phantombuster organization.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List branches.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listBranches());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
