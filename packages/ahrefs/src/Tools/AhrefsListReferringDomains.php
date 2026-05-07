<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List referring domains that link to a target.
 *
 * Returns a summary of domains that have backlinks pointing to the
 * specified target, including domain rating and backlink counts.
 */
class AhrefsListReferringDomains implements Tool
{
    /**
     * @param  AhrefsService  $service  Ahrefs API client.
     */
    public function __construct(
        private AhrefsService $service,
    ) {}

    public function name(): string
    {
        return 'ahrefs_list_referring_domains';
    }

    public function description(): string
    {
        return 'List referring domains that link to a target website. Shows domain-level metrics like domain rating (DR), the number of backlinks from each domain, and first/last seen dates.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target URL or domain to analyze (e.g., "example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of referring domains to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
            'mode' => ['type' => 'string', 'description' => 'Target matching mode: "domain", "subdomains", "exact", or "prefix". Default: "subdomains".'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ahrefs integration is not configured.');
            }

            $target = $args['target'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $mode = $args['mode'] ?? 'subdomains';

            $result = $this->service->listReferringDomains($target, $limit, $offset, $mode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
