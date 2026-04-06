<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

use OpenCompany\Integrations\Ahrefs\AhrefsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List organic keywords a target ranks for in search engines.
 *
 * Returns keyword data including search volume, keyword difficulty,
 * position, traffic, and URL for each ranking keyword.
 */
class AhrefsListOrganicKeywords implements Tool
{
    public function __construct(
        private AhrefsService $service,
    ) {}

    public function name(): string
    {
        return 'ahrefs_list_organic_keywords';
    }

    public function description(): string
    {
        return 'List organic keywords that a target website or URL ranks for in search results. Returns keyword, position, search volume, traffic, keyword difficulty, and the ranking URL.';
    }

    public function parameters(): array
    {
        return [
            'target' => ['type' => 'string', 'required' => true, 'description' => 'The target URL or domain to analyze (e.g., "example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of keywords to return (default: 100).'],
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

            $result = $this->service->listOrganicKeywords($target, $limit, $offset, $mode);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
