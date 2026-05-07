<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get status and metadata for a Splunk search job.
 */
class SplunkGetSearchJob extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_search_job'; }

    public function description(): string { return 'Get status and metadata for a Splunk search job by SID.'; }

    public function parameters(): array
    {
        return ['sid' => ['type' => 'string', 'required' => true, 'description' => 'Search job ID.']];
    }

    /**
     * Get a search job.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSearchJob($this->requiredString($args, 'sid')));
    }
}
