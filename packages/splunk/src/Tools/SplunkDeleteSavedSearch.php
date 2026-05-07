<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Splunk saved search.
 */
class SplunkDeleteSavedSearch extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_delete_saved_search'; }

    public function description(): string { return 'Delete a Splunk saved search by name.'; }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'Saved search name.']];
    }

    /**
     * Delete a saved search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteSavedSearch($this->requiredString($args, 'name')));
    }
}
