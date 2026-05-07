<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel or delete a Splunk search job.
 */
class SplunkDeleteSearchJob extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_delete_search_job'; }

    public function description(): string { return 'Cancel or delete a Splunk search job by SID.'; }

    public function parameters(): array
    {
        return ['sid' => ['type' => 'string', 'required' => true, 'description' => 'Search job ID.']];
    }

    /**
     * Delete a search job.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteSearchJob($this->requiredString($args, 'sid')));
    }
}
