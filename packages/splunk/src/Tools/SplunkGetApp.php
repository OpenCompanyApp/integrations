<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get an installed Splunk app.
 */
class SplunkGetApp extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_app'; }

    public function description(): string { return 'Get an installed Splunk app by name.'; }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'App name.']];
    }

    /**
     * Get an app.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getApp($this->requiredString($args, 'name')));
    }
}
