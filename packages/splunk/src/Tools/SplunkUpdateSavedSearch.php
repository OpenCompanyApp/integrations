<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Splunk saved search.
 */
class SplunkUpdateSavedSearch extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_update_saved_search'; }

    public function description(): string { return 'Update a Splunk saved search by name.'; }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Saved search name.'],
            'options' => ['type' => 'object', 'required' => true, 'description' => 'Saved-search update parameters.'],
        ];
    }

    /**
     * Update a saved search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateSavedSearch(
            $this->requiredString($args, 'name'),
            $this->arrayArg($args, 'options'),
        ));
    }
}
