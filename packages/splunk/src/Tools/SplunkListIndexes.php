<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Splunk indexes available to the authenticated user.
 */
class SplunkListIndexes extends AbstractSplunkTool
{
    public function name(): string
    {
        return 'splunk_list_indexes';
    }

    public function description(): string
    {
        return 'List all Splunk indexes available to the authenticated user. Returns index names, sizes, event counts, and retention settings.';
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of indexes to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * List indexes.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listIndexes(
            $this->integer($args, 'count', 100),
            $this->integer($args, 'offset', 0),
        ));
    }
}
