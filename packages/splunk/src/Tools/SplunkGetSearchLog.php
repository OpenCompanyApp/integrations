<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve search.log for a Splunk search job.
 */
class SplunkGetSearchLog extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_search_log'; }

    public function description(): string { return 'Retrieve the search.log text for a Splunk search job.'; }

    public function parameters(): array
    {
        return ['sid' => ['type' => 'string', 'required' => true, 'description' => 'Search job ID.']];
    }

    /**
     * Get search log text.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSearchLog($this->requiredString($args, 'sid')));
    }
}
