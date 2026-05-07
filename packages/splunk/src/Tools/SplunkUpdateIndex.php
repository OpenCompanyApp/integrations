<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Splunk index.
 */
class SplunkUpdateIndex extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_update_index'; }

    public function description(): string { return 'Update Splunk index configuration parameters.'; }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Index name.'],
            'options' => ['type' => 'object', 'required' => true, 'description' => 'Index update parameters.'],
        ];
    }

    /**
     * Update an index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateIndex(
            $this->requiredString($args, 'name'),
            $this->arrayArg($args, 'options'),
        ));
    }
}
