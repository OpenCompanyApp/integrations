<?php

namespace OpenCompany\Integrations\WpEngine\Tools;

use OpenCompany\Integrations\WpEngine\WpEngineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List WP Engine installs with optional pagination.
 *
 * Returns a paginated list of WordPress installs across all sites on
 * the authenticated WP Engine account.
 */
class WpEngineListInstalls implements Tool
{
    public function __construct(
        private WpEngineService $service,
    ) {}

    public function name(): string
    {
        return 'wp_engine_list_installs';
    }

    public function description(): string
    {
        return 'List WP Engine installs. Supports pagination with limit and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of installs per page (default: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WP Engine integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listInstalls($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
