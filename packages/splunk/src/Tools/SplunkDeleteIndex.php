<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Splunk index.
 */
class SplunkDeleteIndex extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_delete_index'; }

    public function description(): string { return 'Delete a Splunk index by name.'; }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'Index name.']];
    }

    /**
     * Delete an index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteIndex($this->requiredString($args, 'name')));
    }
}
