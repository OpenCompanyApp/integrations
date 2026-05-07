<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Splunk index.
 */
class SplunkGetIndex extends AbstractSplunkTool
{
    public function name(): string
    {
        return 'splunk_get_index';
    }

    public function description(): string
    {
        return 'Get details for a specific Splunk index by name. Returns configuration, size, event count, and retention policy.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Splunk index to retrieve (e.g., "main", "_internal").'],
        ];
    }

    /**
     * Get index details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getIndex($this->requiredString($args, 'name')));
    }
}
