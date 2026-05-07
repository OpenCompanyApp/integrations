<?php

namespace OpenCompany\Integrations\Linode\Tools;

use OpenCompany\Integrations\Linode\LinodeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Linode block storage volumes in the account.
 */
class LinodeListVolumes implements Tool
{
    /**
     * @param  LinodeService  $service  The Linode API client.
     */
    public function __construct(
        private LinodeService $service,
    ) {}

    public function name(): string
    {
        return 'linode_list_volumes';
    }

    public function description(): string
    {
        return 'List all block storage volumes in the Linode account. Returns IDs, labels, size, status, and attached Linode info.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of volumes per page (default: 100).'],
        ];
    }

    /**
     * List volumes using optional Linode pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Linode integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : null;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : null;

            $result = $this->service->listVolumes($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
