<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List top pages for a target website.
 *
 * Returns page-level data including URL, traffic, keywords,
 * and backlink counts for the top-performing pages.
 */
class AhrefsListPages implements Tool
{
    public function __construct(
        private AhrefsService $service,
    ) {}

    public function name(): string
    {
        return 'ahrefs_list_pages';
    }

    public function description(): string
    {
        return 'List top pages for a target website ranked by traffic or other metrics. Returns page URLs along with traffic data, keyword counts, and backlink information.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target URL or domain to analyze (e.g., "example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pages to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
            'mode' => ['type' => 'string', 'description' => 'Target matching mode: "domain", "subdomain", "exact", "prefix". Default: "domain".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ahrefs integration is not configured.');
            }

            $target = $args['target'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $mode = $args['mode'] ?? 'domain';

            $result = $this->service->listPages($target, $limit, $offset, $mode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
