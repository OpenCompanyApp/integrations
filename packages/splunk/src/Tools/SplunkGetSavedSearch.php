<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Splunk saved search by name.
 */
class SplunkGetSavedSearch extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_saved_search'; }

    public function description(): string { return 'Get a Splunk saved search by name.'; }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'Saved search name.']];
    }

    /**
     * Get a saved search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSavedSearch($this->requiredString($args, 'name')));
    }
}
