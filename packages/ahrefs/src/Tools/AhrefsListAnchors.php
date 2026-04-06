<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List anchor texts used in backlinks to a target.
 *
 * Returns anchor text distribution data including the anchor text,
 * number of refpages, and first/last seen dates.
 */
class AhrefsListAnchors implements Tool
{
    public function __construct(
        private AhrefsService $service,
    ) {}

    public function name(): string
    {
        return 'ahrefs_list_anchors';
    }

    public function description(): string
    {
        return 'List anchor texts used in backlinks pointing to a target website. Shows anchor text distribution, the number of referring pages using each anchor, and backlink counts.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target URL or domain to analyze (e.g., "example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of anchors to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
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

            $result = $this->service->listAnchors($target, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
