<?php

namespace OpenCompany\Integrations\Confluence\Tools;

use OpenCompany\Integrations\Confluence\ConfluenceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for Confluence content using CQL (Confluence Query Language).
 */
class ConfluenceSearchPages implements Tool
{
    /** @param  ConfluenceService  $service  The Confluence API client */
    public function __construct(
        private ConfluenceService $service,
    ) {}

    public function name(): string
    {
        return 'confluence_search_pages';
    }

    public function description(): string
    {
        return 'Search for Confluence content using CQL (Confluence Query Language). Examples: \'title = "My Page"\', \'space = "DEV" and type = "page"\'.';
    }

    public function parameters(): array
    {
        return [
            'cql' => ['type' => 'string', 'required' => true, 'description' => 'CQL query string. Example: \'title = "My Page"\' or \'space = "DEV" and type = "page"\'.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results per page. Default: 25.'],
            'start' => ['type' => 'integer', 'description' => 'Start offset for pagination. Default: 0.'],
            'expand' => ['type' => 'string', 'description' => 'Comma-separated list of properties to expand. Example: "body.storage,version,space".'],
        ];
    }

    /**
     * Search Confluence content using a CQL query with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (cql, limit, start, expand)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Confluence is not configured. Missing API token.');
        }

        $cql = $args['cql'] ?? '';

        if (empty($cql)) {
            return ToolResult::error('CQL query is required.');
        }

        try {
            $limit = $args['limit'] ?? null;
            $start = $args['start'] ?? null;
            $expand = $args['expand'] ?? null;

            $result = $this->service->searchPages($cql, $limit, $start, $expand);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
