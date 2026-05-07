<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Dispatch a Splunk saved search.
 */
class SplunkDispatchSavedSearch extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_dispatch_saved_search'; }

    public function description(): string { return 'Dispatch a saved search and return the generated search job.'; }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Saved search name.'],
            'options' => ['type' => 'object', 'description' => 'Dispatch parameters.'],
        ];
    }

    /**
     * Dispatch a saved search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->dispatchSavedSearch(
            $this->requiredString($args, 'name'),
            $this->arrayArg($args, 'options'),
        ));
    }
}
