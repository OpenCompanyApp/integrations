<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve event rows from a completed Splunk search job.
 */
class SplunkGetSearchEvents extends AbstractSplunkTool
{
    public function name(): string { return 'splunk_get_search_events'; }

    public function description(): string { return 'Retrieve event rows from a completed Splunk search job.'; }

    public function parameters(): array
    {
        return [
            'sid' => ['type' => 'string', 'required' => true, 'description' => 'Search job ID.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
            'count' => ['type' => 'integer', 'description' => 'Number of events.'],
        ];
    }

    /**
     * Get search events.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSearchEvents(
            $this->requiredString($args, 'sid'),
            $this->integer($args, 'offset', 0),
            $this->integer($args, 'count', 100),
        ));
    }
}
