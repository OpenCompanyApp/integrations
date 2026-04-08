<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List paid (PPC) keywords a target bids on.
 *
 * Returns keyword data for paid search campaigns including
 * keyword, position, volume, CPC, and the landing page URL.
 */
class AhrefsListPaidKeywords implements Tool
{
    public function __construct(
        private AhrefsService $service,
    ) {}

    public function name(): string
    {
        return 'ahrefs_list_paid_keywords';
    }

    public function description(): string
    {
        return 'List paid (PPC) keywords that a target website bids on in search advertising. Returns keyword, position, search volume, CPC, traffic, and the landing page URL.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target URL or domain to analyze (e.g., "example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of keywords to return (default: 100).'],
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

            $result = $this->service->listPaidKeywords($target, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
