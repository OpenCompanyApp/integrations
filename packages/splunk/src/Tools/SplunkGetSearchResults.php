<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve result rows from a completed Splunk search job.
 */
class SplunkGetSearchResults extends AbstractSplunkTool
{
    public function name(): string
    {
        return 'splunk_get_search_results';
    }

    public function description(): string
    {
        return 'Retrieve results from a completed Splunk search job. Pass the search ID (SID) returned by splunk_search. Supports pagination with offset and count parameters.';
    }

    public function parameters(): array
    {
        return [
            'sid' => ['type' => 'string', 'required' => true, 'description' => 'The search job ID (SID) returned by a previous search.'],
            'offset' => ['type' => 'integer', 'description' => 'The starting offset for pagination (0-based, default: 0).'],
            'count' => ['type' => 'integer', 'description' => 'The number of results to return per page (default: 100).'],
        ];
    }

    /**
     * Retrieve search results.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSearchResults(
            $this->requiredString($args, 'sid'),
            $this->integer($args, 'offset', 0),
            $this->integer($args, 'count', 100),
        ));
    }
}
