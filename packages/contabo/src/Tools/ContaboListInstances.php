<?php

namespace OpenCompany\Integrations\Contabo\Tools;

use OpenCompany\Integrations\Contabo\ContaboService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ContaboListInstances implements Tool
{
    public function __construct(
        private ContaboService $service,
    ) {}

    public function name(): string
    {
        return 'contabo_list_instances';
    }

    public function description(): string
    {
        return 'List all compute instances (VPS) in the Contabo account. Returns IDs, names, status, region, and IP addresses.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of instances per page (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Contabo integration is not configured.');
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
