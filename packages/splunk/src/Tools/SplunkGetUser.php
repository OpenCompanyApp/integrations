<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Splunk user by username.
 */
class SplunkGetUser extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_user'; }

    public function description(): string { return 'Get a Splunk user by username.'; }

    public function parameters(): array
    {
        return ['username' => ['type' => 'string', 'required' => true, 'description' => 'Splunk username.']];
    }

    /**
     * Get a user.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getUser($this->requiredString($args, 'username')));
    }
}
