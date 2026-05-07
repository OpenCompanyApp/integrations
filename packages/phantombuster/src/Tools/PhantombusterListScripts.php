<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Phantombuster scripts.
 */
class PhantombusterListScripts extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_list_scripts';
    }

    public function description(): string
    {
        return 'List scripts available to the authenticated Phantombuster user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List scripts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listScripts());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
