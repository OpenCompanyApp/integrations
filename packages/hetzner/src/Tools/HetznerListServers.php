<?php

namespace OpenCompany\Integrations\Hetzner\Tools;

use OpenCompany\Integrations\Hetzner\HetznerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Hetzner Cloud servers with optional pagination.
 *
 * Returns a paginated list of servers on the authenticated Hetzner Cloud account.
 * Use the `per_page` and `page` parameters to control pagination.
 */
class HetznerListServers implements Tool
{
    public function __construct(
        private HetznerService $service,
    ) {}

    public function name(): string
    {
        return 'hetzner_list_servers';
    }

    public function description(): string
    {
        return 'List Hetzner Cloud servers. Supports pagination with per_page and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of servers per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hetzner Cloud integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listServers($perPage, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
