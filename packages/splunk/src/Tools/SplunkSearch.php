<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an asynchronous Splunk search job.
 */
class SplunkSearch extends AbstractSplunkTool
{
    public function name(): string
    {
        return 'splunk_search';
    }

    public function description(): string
    {
        return 'Run a Splunk search query (SPL). Creates an asynchronous search job and returns the search ID (SID). Use splunk_get_search_results to retrieve results once the job completes.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The SPL search query (e.g., "search index=main error | head 100").'],
            'earliest_time' => ['type' => 'string', 'description' => 'Earliest time for the search time range. Supports relative (e.g., "-24h", "-7d") or absolute (e.g., "2025-01-01T00:00:00") format.'],
            'latest_time' => ['type' => 'string', 'description' => 'Latest time for the search time range. Supports relative (e.g., "now") or absolute (e.g., "2025-01-31T23:59:59") format.'],
            'exec_mode' => ['type' => 'string', 'description' => 'Splunk execution mode. Defaults to normal.'],
            'options' => ['type' => 'object', 'description' => 'Additional search/jobs form parameters.'],
        ];
    }

    /**
     * Create a search job.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->search(
            $this->requiredString($args, 'query'),
            $this->string($args, 'earliest_time') ?: null,
            $this->string($args, 'latest_time') ?: null,
            $this->string($args, 'exec_mode', 'normal') ?: 'normal',
            $this->arrayArg($args, 'options'),
        ));
    }
}
