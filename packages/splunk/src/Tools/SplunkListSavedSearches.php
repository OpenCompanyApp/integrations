<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List saved searches configured in Splunk.
 */
class SplunkListSavedSearches extends AbstractSplunkTool
{
    public function name(): string
    {
        return 'splunk_list_saved_searches';
    }

    public function description(): string
    {
        return 'List all saved searches configured in Splunk. Returns search names, queries, schedules, and alert settings.';
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of saved searches to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
            'search' => ['type' => 'string', 'description' => 'Optional server-side search filter.'],
        ];
    }

    /**
     * List saved searches.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSavedSearches(
            $this->integer($args, 'count', 100),
            $this->integer($args, 'offset', 0),
            $this->string($args, 'search') ?: null,
        ));
    }
}
