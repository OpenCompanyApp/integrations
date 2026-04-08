<?php

namespace OpenCompany\Integrations\Linode\Tools;

use OpenCompany\Integrations\Linode\LinodeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LinodeListInstances implements Tool
{
    public function __construct(
        private LinodeService $service,
    ) {}

    public function name(): string
    {
        return 'linode_list_instances';
    }

    public function description(): string
    {
        return 'List all Linode instances (virtual machines) in the account. Returns IDs, labels, status, type, region, and IP addresses.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of instances per page (default: 100, max: 500).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Linode integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : null;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : null;

            $result = $this->service->listInstances($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
