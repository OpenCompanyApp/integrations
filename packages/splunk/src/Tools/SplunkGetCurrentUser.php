<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated Splunk user context.
 */
class SplunkGetCurrentUser extends AbstractSplunkTool
{
    public function name(): string
    {
        return 'splunk_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated Splunk user context. Returns username, roles, capabilities, and tenant information.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current user context.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getCurrentUser());
    }
}
