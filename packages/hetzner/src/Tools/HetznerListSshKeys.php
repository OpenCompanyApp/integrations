<?php

namespace OpenCompany\Integrations\Hetzner\Tools;

use OpenCompany\Integrations\Hetzner\HetznerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Hetzner Cloud SSH keys with optional pagination.
 *
 * Returns a paginated list of SSH keys on the authenticated Hetzner Cloud account.
 * Use the `per_page` and `page` parameters to control pagination.
 */
class HetznerListSshKeys implements Tool
{
    public function __construct(
        private HetznerService $service,
    ) {}

    public function name(): string
    {
        return 'hetzner_list_ssh_keys';
    }

    public function description(): string
    {
        return 'List Hetzner Cloud SSH keys. Supports pagination with per_page and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of SSH keys per page (default: 25).'],
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

            $result = $this->service->listSshKeys($perPage, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
