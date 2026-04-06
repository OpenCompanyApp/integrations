<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List backlinks pointing to a target website or URL.
 *
 * Returns detailed backlink data including source URL, anchor text,
 * and link attributes for the specified target.
 */
class AhrefsListBacklinks implements Tool
{
    public function __construct(
        private AhrefsService $service,
    ) {}

    public function name(): string
    {
        return 'ahrefs_list_backlinks';
    }

    public function description(): string
    {
        return 'List backlinks pointing to a target website or URL. Use this to analyze a site\'s link profile, find linking pages, anchor texts, and backlink quality metrics.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target URL or domain to analyze (e.g., "example.com" or "https://example.com/page").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of backlinks to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
            'mode' => ['type' => 'string', 'description' => 'Target matching mode: "domain" (all subdomains), "subdomain" (specific subdomain), "exact" (exact URL), "prefix" (URL prefix). Default: "domain".'],
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

            $result = $this->service->listBacklinks($target, $limit, $offset, $mode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
