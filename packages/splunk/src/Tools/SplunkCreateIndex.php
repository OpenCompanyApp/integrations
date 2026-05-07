<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Splunk index.
 */
class SplunkCreateIndex extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_create_index'; }

    public function description(): string { return 'Create a Splunk index with optional index settings.'; }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Index name.'],
            'options' => ['type' => 'object', 'description' => 'Additional index creation parameters.'],
        ];
    }

    /**
     * Create an index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createIndex(
            $this->requiredString($args, 'name'),
            $this->arrayArg($args, 'options'),
        ));
    }
}
