<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Splunk saved search.
 */
class SplunkCreateSavedSearch extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_create_saved_search'; }

    public function description(): string { return 'Create a Splunk saved search with optional schedule or alert settings.'; }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Saved search name.'],
            'query' => ['type' => 'string', 'required' => true, 'description' => 'SPL query.'],
            'options' => ['type' => 'object', 'description' => 'Additional saved-search parameters.'],
        ];
    }

    /**
     * Create a saved search.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createSavedSearch(
            $this->requiredString($args, 'name'),
            $this->requiredString($args, 'query'),
            $this->arrayArg($args, 'options'),
        ));
    }
}
