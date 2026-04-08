<?php

namespace OpenCompany\Integrations\Splunk\Tools;

use OpenCompany\Integrations\Splunk\SplunkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplunkGetSearchResults implements Tool
{
    public function __construct(
        private SplunkService $service,
    ) {}

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

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Splunk integration is not configured.');
            }

            $sid = $args['sid'] ?? '';
            if (empty($sid)) {
                return ToolResult::error('Search ID (SID) is required.');
            }

            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $count = isset($args['count']) ? (int) $args['count'] : 100;

            $result = $this->service->getSearchResults($sid, $offset, $count);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
