<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\Integrations\Splunk\SplunkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplunkSearch implements Tool
{
    public function __construct(
        private SplunkService $service,
    ) {}

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
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splunk integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('Search query is required.');
            }

            $result = $this->service->search(
                $query,
                $args['earliest_time'] ?? null,
                $args['latest_time'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
